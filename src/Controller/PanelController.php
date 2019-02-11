<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanelController extends AbstractController
{
    /**
     * @Route("/panel", name="Panel.index")
     */
    public function index()
    {
        return $this->render('panel/index.html.twig', [
        ]);
    }

	/**
	 * @Route("/testpdf", name="Panel.testPdf")
	 */
	public function firstPdfDomPDF() {
		$dompdf = new Dompdf();
		$html = $this->renderView('pdf/test.html.twig',[
		    'test' => "test"
        ]);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream("mypdf.pdf", [
			"Attachment" => 0
		]);
	}
}
