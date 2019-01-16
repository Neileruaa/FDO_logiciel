<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BDDController extends AbstractController
{
    /**
     * @Route("/importer", name="Import")
     */
    public function importer()
    {
        $command = "mysql --user=antoi --password=0704 "
            . "-h localhost -D fdo_logiciel < ../baseDeDonnees/baseDeDonnees.sql";

        shell_exec($command);
        return $this->render('home/index.html.twig', [
        ]);
    }
}
