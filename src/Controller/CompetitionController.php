<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Sauvegarde;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;


class CompetitionController extends AbstractController
{
    /**
     * @Route("/", name="Home.index")
     * @param Request $request
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, SessionInterface $session)
    {
        $sauvegardes=$this->getDoctrine()->getRepository(Sauvegarde::class)->findAll();
        if (sizeof($sauvegardes)>0){
            $session->set('competSelected', $sauvegardes[0]->getIdCompetition());
            $session->set('selection', true);
        }
        $competitions=$this->getDoctrine()->getRepository(Competition::class)->findAll();
        return $this->render('home/index.html.twig', [
            'competitions' => $competitions,
        ]);
    }
}
