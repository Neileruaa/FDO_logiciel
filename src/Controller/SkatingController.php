<?php
/**
 * Created by PhpStorm.
 * User: matteo
 * Date: 02/02/2019
 * Time: 16:14
 */

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Judge;
use App\Entity\Team;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;

class SkatingController extends AbstractController
{

    /**
     * @Route("/tour", name="Final.index")
     */
    public function initFinal(Request $request)
    {
        $compet=$this->getDoctrine()->getRepository(Competition::class)->find($this->get("session")->get('competSelected'));

        $teams=$compet->getTeams();
        $judges=$compet->getJudges();

        return $this->render('skatingSystem/tourFinal.html.twig', [
            'competition' => $compet,/*
            'judges' => $judges,
            'teams' => $teams*/
        ]);
    }

    /**
     * @Route("/tour/choice/{idJudge}/{idTeam}", name="Tour.choice", methods={"GET"})
     */
    public function judgeChoice(Request $request)
    {
        $compet=$this->getDoctrine()->getRepository(Competition::class)->find($this->get("session")->get('competSelected'));

        $this->redirectToRoute("Final.index");
    }
}