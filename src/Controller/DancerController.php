<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DancerController extends AbstractController
{
    /**
     * @Route("/dancer", name="Dancer.showAll")
     */
    public function index() {
        return $this->render('dancer/index.html.twig', [

        ]);
    }
}
