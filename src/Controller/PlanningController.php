<?php

namespace App\Controller;

use App\Entity\Competition;
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
	    $compet = $this->get("session")->get('competSelected');
	    $compet=$this->getDoctrine()->getRepository(Competition::class)->find($compet);
	    //dump($compet);
		    //dump($compet->getDances());
		    foreach ($compet->getDances() as $dance){
			    dump($dance->getNameDance());
		    }
        return $this->render('planning/index.html.twig', [

        ]);
    }

    /**
     * @Route("/testAjax", name="Planning.testAjax", methods={"GET"})
     */
    public function testAjax(){

//    	$compet = $this->get("session")->get('competSelected');
//
//    	dump("test");

	    $row = [
    		['id'=>0, 'Dance'=>'Salsa', 'Categorie'=>'duo', 'Age'=>'Adulte', 'Round'=>1, 'Piste'=> 'A'],
    		['id'=>1, 'Dance'=>'Salsa', 'Categorie'=>'solo', 'Age'=> 'Enfant', 'Round'=>2, 'Piste'=> 'B' ],
    		['id'=>2, 'Dance'=>'HipHop', 'Categorie'=>'Formations', 'Age'=>'Junior', 'Round'=>'Finale', 'Piste'=> 'A'],
    		['id'=>3, 'Dance'=>'HipHop', 'Categorie'=>'duo', 'Age'=>'Adulte', 'Round'=>1, 'Piste'=> 'B'],
	    ];


		    return $this->json(['row'=>$row]);
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
