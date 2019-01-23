<?php

namespace App\Controller;

use App\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompetitionController extends AbstractController
{
    /**
     * @Route("/", name="Home.index")
     */
    public function index()
    {
        $competitions=$this->getDoctrine()->getRepository(Competition::class)->findAll();
        return $this->render('home/index.html.twig', [
            'competitions' => $competitions,
        ]);
    }
}
