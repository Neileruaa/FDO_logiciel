<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Resultat;
use App\Entity\Row;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;


class TeamController extends AbstractController
{
    /**
     * @Route("/competition/{id}/appel", name="Team.appel", requirements={"page"="\d+"})
     */
    public function appel(Competition $competition, ObjectManager $manager, Request $request, SessionInterface $session)
    {
        $manager->detach($competition);
        $session->set('competSelected', $competition->getId());
        $teams=$competition->getTeams();
        return $this->render('team/appel.html.twig', [
            'teams'=>$teams,
            'compet'=>$competition
        ]);
    }

    /**
     * @Route("/competition/{title}/appel/valide", name="Team.appelValide", requirements={"page"="\d+"})
     */
    public function valideAppel(Request $request, ObjectManager $manager, SessionInterface $session){
        $competition=$session->get('competSelected');
        $rowController=new RowController();

        $cr=$this->getDoctrine()->getRepository(Competition::class);
        $rr=$this->getDoctrine()->getRepository(Row::class);
        $dr=$this->getDoctrine()->getRepository(Dance::class);
        $tr=$this->getDoctrine()->getRepository(Team::class);
        $catr=$this->getDoctrine()->getRepository(Category::class);

        $teams=$this->getDoctrine()->getRepository(Competition::class)->find($competition)->getTeams();
        foreach ($teams as $team){
            $idTeam=$team->getId();
            $statut=$request->request->get("appel".$idTeam);
            if ($statut=="present") $team->setIsPresent(true);
            elseif ($statut=="absent") $team->setIsPresent(false);
            $manager->merge($team);
            $manager->flush();
        }
        $rowController->deleteRows($manager, $session, $cr, $rr);
        $rowController->insertRows($manager, $session, $cr, $rr, $dr, $tr, $catr);


        return $this->redirectToRoute("Planning.index");
    }
}
