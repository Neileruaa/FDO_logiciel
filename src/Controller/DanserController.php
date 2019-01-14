<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DanserController extends AbstractController
{
    /**
     * @Route("/danser", name="danser")
     */
    public function index()
    {
        return $this->render('danser/index.html.twig', [
            'controller_name' => 'DanserController',
        ]);
    }
}
