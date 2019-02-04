<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Row;
use App\Repository\CategoryRepository;
use App\Repository\DanceRepository;
use App\Repository\RowRepository;
use Doctrine\Common\Persistence\ObjectManager;
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
	public function testAjaxPost(Request $request,
	                             ObjectManager $manager,
	                             CategoryRepository $categoryRepository,
	                             DanceRepository $danceRepository,
	                             RowRepository $rowRepository) {
//		$rows = $request->getContent();

		$parametersAsArray = array();
		if ($content = $request->getContent()){
			$parametersAsArray = json_decode($content, true);
		}

		//vide la table Row
		$rows = $rowRepository->findAll();
		foreach ($rows as $line){
			$manager->remove($line);
		}
		$manager->flush();

		foreach ($parametersAsArray as $param){
			foreach ($param as $rows){
				$category= $categoryRepository->findOneBy(['nameCategory'=>$rows['Age']]);
				$dance = $danceRepository->findOneBy(['nameDance'=>$rows['Dance']]);
				$row = new Row();
				$row->setDance($dance)
					->setCategory($category)
					->setFormation($rows['Categorie'])
					->setNumTour($rows['Round'])
					->setPiste($rows['Piste'])
					->setIsDone(false)
					->setPassageSimul(4)
				;
				$manager->persist($row);
			}
		}
		$manager->flush();
		return new Response('test');
    }

    /**
     * @Route("/planning/actuel", name="Planning.actualPlanning")
     */
	public function actualPlanning(RowRepository $rowRepository) {
		dump($rowRepository->findAll());
		return $this->render('planning/planningActuel.html.twig',[
			'rows'=>$rowRepository->findAll(),
		]);
    }
}
