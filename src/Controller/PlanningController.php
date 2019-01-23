<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    /**
     * @Route("/planning", name="Planning.index")
     */
    public function index() {
        return $this->render('planning/index.html.twig', [

        ]);
    }
}
