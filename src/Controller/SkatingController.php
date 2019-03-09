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
use App\Entity\Resultat;
use App\Entity\Row;
use App\Entity\Team;

use Doctrine\Common\Persistence\ObjectManager;
use Dompdf\Dompdf;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
            'row' => $row,
            'classement'=>null
        ]);
    }

    /**
     * @Route("/final/classement", name="Final.classement")
     */
    public function classementFinal(Request $request, ObjectManager $manager){
        $resultsFin=$request->get('finale');

        $rowId=$request->get('rowId');
        $row=$this->getDoctrine()->getRepository(Row::class)->find($rowId);
        $rows=$this->getDoctrine()->getRepository(Row::class)->findSameRows($row->getDance(), $row->getCategory(), $row->getFormation(),'Finale');
        $results=[];

        $classement=[];
        foreach ($rows as $r) {
            $teamRetenues=$r->getNbChoosen();
            $resultatsTmp=$this->getDoctrine()->getRepository(Resultat::class)->getResultsFromRow($r);
            for ($i=0; $i<(sizeof($resultatsTmp)-$teamRetenues);$i++){
                array_push($results,$resultatsTmp[$i]);
            }
        }
        foreach ($results as $r) {
            $l = [$r->getNote(), $r->getTeam()->getId()];
            array_push($classement,$l);
        }

        for ($i=sizeof($resultsFin)-1;$i>=0;$i--){
            $l=[strval($classement[sizeof($classement)-1][0]+1),intval($resultsFin[$i])];
            array_push($classement,$l);
        }
        //if (sizeof($classement)<=3){
            for ($i=0;$i<sizeof($classement);$i++){
                $team=$this->getDoctrine()->getRepository(Team::class)->find($classement[$i][1]);
                $res=new Resultat();
                $res->setNote($classement[$i][0]);
                $res->setRow($row);
                $res->setTeam($team);
                $team->addResultat($res);
                $manager->persist($res);
                $manager->persist($team);
                $manager->flush();
            }

        //}
        return $this->json(["classement"=>$classement,
                "row"=>$rowId
            ]);
    }
    /**
     * @Route("/final/resultats/{id}", name="Final.resultats", requirements={"page"="\d+"})
     */
    public function pdfClassement(Request $request, Row $row, SessionInterface $session){
        //$row=$this->getDoctrine()->getRepository(Row::class)->find($request->get('row'));
        $rows=$this->getDoctrine()->getRepository(Row::class)->findSameRows($row->getDance(),$row->getCategory(),$row->getFormation(),9);
        array_push($rows,$this->getDoctrine()->getRepository(Row::class)->findOneBy(['dance'=>$row->getDance(), 'category'=>$row->getCategory(), 'formation'=>$row->getFormation(), 'numTour'=>"Finale"]));
        $resultatsTmp=[];
        $resultats=[];

        foreach ($rows as $r){
            if ($r->getNumTour()=='Finale') $resultatsTmp=$r->getResults();
        }
        foreach ($resultatsTmp as $r){
            $l=[$r->getNote(),$r->getTeam()->getId()];
            array_push($resultats,$l);
        }
        arsort($resultats);

        $session->set('resultats', $resultats);

        return $this->render('resultatsFinale.html.twig',[
            'resultats'=>$resultats,
            'row'=>$row
        ]);
    }

    /**
     * @Route("/final/imprimer/podium/{id}", name="Final.imprimer.podium")
     * @param Row $row
     * @param Request $request
     */
    public function printPodium(Row $row, SessionInterface $session){
        $podium=$session->get('resultats');

        $resultats=[];
        array_push($resultats,$podium[0]);
        array_push($resultats,$podium[1]);
        array_push($resultats,$podium[2]);

        $dompdf = new Dompdf();
        $html = $this->renderView('pdf/classementPodium.html.twig',['row'=>$row ,'resultats'=>$resultats]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("resultatsPodium.pdf", [
            "Attachment" => 0
        ]);
    }

    /**
     * @Route("/final/imprimer/resultats/{id}", name="Final.imprimer.resultats")
     */
    public function printResultatsFinal(Row $row, SessionInterface $session){
        $podium=$session->get('resultats');
        $resultats=[];
        for ($i=3;$i<sizeof($podium);$i++){
            array_push($resultats,$podium[$i]);
        }

        $dompdf = new Dompdf();
        $html = $this->renderView('pdf/classementNonPodium.html.twig',['row'=>$row ,'resultats'=>$resultats]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("resultatsNonPodium.pdf", [
            "Attachment" => 0
        ]);
    }

}