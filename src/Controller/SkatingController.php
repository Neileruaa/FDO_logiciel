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
use phpDocumentor\Reflection\Types\This;
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
        dump($resultsFin);
        $rowId=$request->get('rowId');
        $row=$this->getDoctrine()->getRepository(Row::class)->find($rowId);
        $rows=$this->getDoctrine()->getRepository(Row::class)->findSameRows($row->getDance(), $row->getCategory(), $row->getFormation(),'Finale');
        $results=[];
        $classement=[];

        //si on est passé directement à une finale
        if (sizeof($rows)==0){
            //ici on drop les resultats de la finale courantes pour ne pas multiplier les resultats
            $allResults=$this->getDoctrine()->getRepository(Resultat::class)->findBy(['row'=>$row]);
            foreach ($allResults as $each){
                $manager->remove($each);
                $manager->flush();
            }
            //$cmpt=sizeof($resultsFin);
            $resultatsTmp=[];
            foreach ($resultsFin as $res){
                //dump($res[1]);
                $r=new Resultat();
                $r->setTeam($this->getDoctrine()->getRepository(Team::class)->find($res[0]));
                $r->setNote($res[1]);
                $r->setRow($row);
                array_push($resultatsTmp,$r);
                //$cmpt--;
            }
            for ($i=0; $i<(sizeof($resultatsTmp));$i++){
                array_push($results,$resultatsTmp[$i]);
            }
            foreach ($results as $r) {
                $l = [$r->getNote(), $r->getTeam()->getId()];
                array_push($classement,$l);
            }
        }
        else{
            $allResults=$this->getDoctrine()->getRepository(Resultat::class)->findBy(['row'=>$row]);
            foreach ($allResults as $each){
                $manager->remove($each);
                $manager->flush();
            }
            //dump($rows);
            foreach ($rows as $r) {
                $teamRetenues=$r->getNbChoosen();
                $resultatsTmp=$this->getDoctrine()->getRepository(Resultat::class)->getResultsFromRow($r);
                //dump($resultatsTmp);
                for ($i=0; $i<(sizeof($resultatsTmp)-$teamRetenues);$i++){
                    array_push($results,$resultatsTmp[$i]);
                }
            }
            //dump($results);
            $cmptPlace=sizeof($results)+sizeof($resultsFin);
            foreach ($results as $r) {
                $l = [$cmptPlace, $r->getTeam()->getNumDossard()];
                $cmptPlace--;
                array_push($classement,$l);
            }
            for ($i=sizeof($resultsFin)-1;$i>=0;$i--){
                $l=[intval($resultsFin[$i][1]),intval($resultsFin[$i][0])];
                //dump($l);
                array_push($classement,$l);
            }
        }

        for ($i=0;$i<sizeof($classement);$i++){
            if (is_float(intval($classement[$i][0]))){
                dump($classement[$i][0]);die;
            }
        }

        //dump($classement);
        //if (sizeof($classement)<=3){
        for ($i=0;$i<sizeof($classement);$i++){
            dump($classement);
            $team=$this->getDoctrine()->getRepository(Team::class)->findOneBy(["numDossard"=>$classement[$i][1]]);
            //dump($classement[$i][1]);
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
     * @param Request $request
     * @param Row $row
     * @param SessionInterface $session
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pdfClassement(Request $request, Row $row, SessionInterface $session, ObjectManager $manager){
        //$row=$this->getDoctrine()->getRepository(Row::class)->find($request->get('row'));
        $rows=$this->getDoctrine()->getRepository(Row::class)->findSameRows($row->getDance(),$row->getCategory(),$row->getFormation(),9);
        array_push($rows,$this->getDoctrine()->getRepository(Row::class)->findOneBy(['dance'=>$row->getDance(), 'category'=>$row->getCategory(), 'formation'=>$row->getFormation(), 'numTour'=>"Finale"]));
        //dump($rows);die;
        $row->setIsDone(true);
        $manager->persist($row);
        $manager->flush();

        $resultatsTmp=[];
        $resultats=[];

        foreach ($rows as $r){
            if ($r->getNumTour()=='Finale'){ $resultatsTmp=$r->getResults();}
        }

        foreach ($resultatsTmp as $r){
            $l=[$r->getNote(),$r->getTeam()->getNumDossard()];
            array_push($resultats,$l);
        }
        asort($resultats);
        $session->set('resultats', $resultats);
        return $this->render('resultat/resultatsFinale.html.twig',[
            'resultats'=>$resultats,
            'row'=>$row
        ]);
    }

    /**
     * @Route("/final/imprimer/podium/{id}", name="Final.imprimer.podium")
     * @param Row $row
     * @param SessionInterface $session
     */
    public function printPodium(Row $row, SessionInterface $session){
        $podium=$session->get('resultats');
        $resultats=[];
        for($i=0;$i<sizeof($podium);$i++){
            if (intval($podium[$i][0])<=3){
                array_push($resultats,$podium[$i]);
            }
        }
        asort($resultats);
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
     * @param Row $row
     * @param SessionInterface $session
     */
    public function printResultatsFinal(Row $row, SessionInterface $session){
        $podium=$session->get('resultats');
        //dump($podium);die;
        $resultats=[];
        for ($i=0;$i<sizeof($podium);$i++){
            if (intval($podium[$i][0])>3){
                array_push($resultats,$podium[$i]);
            }
        }
        asort($resultats);
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