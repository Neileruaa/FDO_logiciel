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
        $username="antoi";
        $password="0704";
        $database="fdo_logiciel";
        $command='mysql -u '.$username.' -p'.$password.' -D '.$database.' -e "drop database '.$database.'"';
        shell_exec($command);
        $command='mysql -u '.$username.' -p'.$password.' -e "create database '.$database.'"';
        shell_exec($command);
        $command = "mysql -u ".$username." -p".$password." ".$database." < ../baseDeDonnees/baseDeDonnees.sql";
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
