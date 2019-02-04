<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Row;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;


class TeamController extends AbstractController
{
    /**
     * @Route("/competition/{id}/appel", name="Team.appel", requirements={"page"="\d+"})
     */
    public function appel(Competition $competition, ObjectManager $manager, Request $request)
    {
        $manager->detach($competition);
        $session=$this->get('session');
        $session->set('competSelected', $competition->getId());

        $teams=$competition->getTeams();
        foreach ($teams as $team){
            //dump($team->getIsPresent());
            //die();
        }
        return $this->render('team/appel.html.twig', [
            'teams'=>$teams,
            'compet'=>$competition
        ]);
    }

    /**
     * @Route("/competition/{title}/appel/valide", name="Team.appelValide", requirements={"page"="\d+"})
     */
    public function valideAppel(Request $request, ObjectManager $manager){
        $session=$this->get('session');
        $competition=$this->get("session")->get('competSelected');
        $this->deleteRows($manager);
        $rows=$this->getDoctrine()->getRepository(Competition::class)->getRows($session->get('competSelected'));

        foreach ($rows as $row){
            $newRow=new Row();
            //dump($row);
            $dance=$this->getDoctrine()->getRepository(Dance::class)->findBy(['nameDance'=>$row['nameDance']]);
            $newRow->setDance($dance[0]);

            $newRow->setNumTour(1);

            $category=$this->getDoctrine()->getRepository(Category::class)->findBy(['nameCategory'=>$row['nameCategory']]);
            $newRow->setCategory($category[0]);

            $newRow->setFormation($row['size']);

            $teams=$this->getDoctrine()->getRepository(Team::class)->getTeamsByCat($row['nameDance'], $row['nameCategory'], $row['size']);
            foreach ($teams as $team){
                $t=$this->getDoctrine()->getRepository(Team::class)->find($team);
                $newRow->addTeam($t);
            }
            $c=$this->getDoctrine()->getRepository(Competition::class)->find($competition);
            dump($c);
            $newRow->setCompetition($c);
            $newRow->setIsDone(false);
            $newRow->setPiste("A");
            $manager->persist($newRow);
            $manager->flush();
        }

        $teams=$this->getDoctrine()->getRepository(Competition::class)->find($competition)->getTeams();

        foreach ($teams as $team){
            $idTeam=$team->getId();
            $statut=$request->request->get("appel".$idTeam);
            if ($statut=="present") $team->setIsPresent(true);
            elseif ($statut=="absent") $team->setIsPresent(false);
            $manager->merge($team);
            $manager->flush();
        }
        return $this->redirectToRoute("Planning.index");
    }

    public function deleteRows(ObjectManager $manager){
        $compet=$this->get("session")->get('competSelected');
        $compet=$this->getDoctrine()->getRepository(Competition::class)->find($compet);
        $rows=$this->getDoctrine()->getRepository(Row::class)->findBy(['competition'=>$compet]);
        foreach ($rows as $row){
            $manager->remove($row);
            $manager->flush();
        }
    }
}
