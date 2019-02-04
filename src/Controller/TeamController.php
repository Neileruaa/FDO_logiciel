<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Row;
use App\Entity\Team;
use Doctrine\Common\Persistence\ObjectManager;
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
        //dump();
        //die();
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
    public function valideAppel(Request $request){
        $session=$this->get('session');
        $rows=$this->getDoctrine()->getRepository(Competition::class)->getRows($session->get('competSelected'));
        $newRow=new Row();
        foreach ($rows as $row){
            $newRow->setDance($row[0]);
            $newRow->setNumTour(1);
        }

        $manager=$this->getDoctrine()->getManager();
        $competition=$this->get("session")->get('competSelected');
        $teams=$competition->getTeams();

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
}
