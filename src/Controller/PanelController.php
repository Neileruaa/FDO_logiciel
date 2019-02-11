<?php

namespace App\Controller;

use App\Entity\Competition;
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
        $html = $this->renderView('pdf/test.html.twig',['rows'=>$this->getDoctrine()->getRepository(Row::class)->findBy(['competition'=>$compet])]);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream("mypdf.pdf", [
			"Attachment" => 0
		]);
	}
}
