<?php

namespace App\Controller;

use App\Entity\Row;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ResultatController extends AbstractController
{
    /**
     * @Route("/row/result/{id}", name="Resultat.index")
     * @param Row $row
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Row $row){
        dump($row);
        return $this->render("resultat/index.html.twig", [
            'row'=>$row
        ]);
    }
}
