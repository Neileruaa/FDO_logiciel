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

        //$conn = mysqli_connect('localhost', 'antoi', '0704', 'fdo_logiciel');
        // Check connection
        //if (!$conn) {
        //    die("Connection failed: " . mysqli_connect_error());
        //}
        //$sql = "ALTER TABLE ";
        //mysqli_query($conn, $sql);
        return $this->render('home/index.html.twig', [
        ]);
    }
}
