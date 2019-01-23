<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Team;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/competition/{title}/appel", name="Team.appel", requirements={"page"="\d+"})
     */
    public function appel(Competition $competition, ObjectManager $manager, Request $request)
    {
        $teams=$competition->getTeams();

        return $this->render('team/appel.html.twig', [
            'teams'=>$teams
        ]);
    }
}
