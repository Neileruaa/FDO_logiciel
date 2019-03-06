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
use App\Entity\Row;
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
     * @Route("/final/{rowId}", name="Final.index", methods={"GET"})
     */
    public function initFinal(Request $request,$rowId)
    {
        $row=$this->getDoctrine()->getRepository(Row::class)->find($rowId);

        return $this->render('skatingSystem/tourFinal.html.twig', [
            'row' => $row
        ]);
    }
}