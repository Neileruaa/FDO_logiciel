<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/testAjax", name="Planning.testAjax", methods={"GET"})
     */
    public function testAjax(){

    	$teams = [
    		['id'=>0, 'numTeam'=>0, 'isPresent'=>0, 'round'=>1],
    		['id'=>1, 'numTeam'=>1, 'isPresent'=>1, 'round'=>1],
    		['id'=>2, 'numTeam'=>2, 'isPresent'=>1, 'round'=>1],
    		['id'=>3, 'numTeam'=>3, 'isPresent'=>0, 'round'=>'Finale'],
	    ];


    	return $this->json(['teams'=>$teams]);
    }

    /**
     * @Route("/testAjaxPost", name="Planning.testAjaxPost", methods={"POST"})
     */
	public function testAjaxPost(Request $request) {
		$number = $request->request->get('number');
		dump($number);
		return new Response($number);
    }
}
