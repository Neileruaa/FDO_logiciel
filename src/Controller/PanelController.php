<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Resultat;
use App\Entity\Row;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanelController extends AbstractController
{
	/**
	 * @Route("/planning/pdf", name="Panel.testPdf")
	 */
	public function firstPdfDomPDF(SessionInterface $session) {
	    $compet=$this->getDoctrine()->getRepository(Competition::class)->find($session->get('competSelected'));
        $dompdf = new Dompdf();
        $html = $this->renderView('pdf/test.html.twig',['rows'=>$this->getDoctrine()->getRepository(Row::class)->findToDoRow()]);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream("mypdf.pdf", [
			"Attachment" => 0
		]);
	}

	/**
     * @Route("/resultats/pdf/{id}", name="Resultat.testpdf")
     */
	public function createPdfResultat(SessionInterface $session, Row $row){
        $resultats=$this->getDoctrine()->getRepository(Resultat::class)->findByRow($row);
        $dompdf = new Dompdf();
        $html = $this->renderView('pdf/resultats.html.twig',['row'=>$row ,'resultats'=>$resultats]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("resultats.pdf", [
            "Attachment" => 0
        ]);
    }
}
