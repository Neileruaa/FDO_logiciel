<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Resultat;
use App\Entity\Row;
use App\Entity\Team;
use App\Repository\CategoryRepository;
use App\Repository\CompetitionRepository;
use App\Repository\DanceRepository;
use App\Repository\RowRepository;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use http\Env\Response;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RowController extends AbstractController
{
    public function deleteRows(ObjectManager $manager, SessionInterface $session, CompetitionRepository $cr, RowRepository $rr){
        $compet=$session->get('competSelected');
        $compet=$cr->find($compet);

        $rows=$rr->findAll();
        foreach ($rows as $row){
            $manager->remove($row);
            $manager->flush();
        }
    }

    public function insertRows(ObjectManager $manager, SessionInterface $session, CompetitionRepository $cr, RowRepository $rr, DanceRepository $dr, TeamRepository $tr, CategoryRepository $catr){
        $competition=$session->get('competSelected');
        $rows=$cr->getRows($session->get('competSelected'));

        foreach ($rows as $row){
            $newRow=new Row();
            $dance=$dr->findBy(['nameDance'=>$row['nameDance']]);
            $newRow->setDance($dance[0]);

            $newRow->setNumTour("1");

            $category=$catr->findBy(['nameCategory'=>$row['nameCategory']]);
            $newRow->setCategory($category[0]);

            $newRow->setFormation($row['size']);

            $newRow->setPassageSimul(2);
            $newRow->setNbJudge(3);

            $teams=$tr->getTeamsByCat($row['nameDance'], $row['nameCategory'], $row['size'], $competition);

            if ($teams==null){
                continue;
            }
            foreach ($teams as $team){
                $t=$tr->find($team);
                $newRow->addTeam($t);
            }
            $competition=$cr->find($competition);
            $newRow->setCompetition($competition);
            $newRow->setIsDone(false);
            $newRow->setPiste("A");
            $manager->persist($newRow);
            $manager->flush();
        }
    }


    function array_kshift(&$arr){
        list($k) = array_keys($arr);
        $r  = array($k=>$arr[$k]);
        unset($arr[$k]);
        return $r;
    }

    /**
     * @Route("/create/rows/afterResult", name="Row.createAfterResult")
     * @param ObjectManager $manager
     * @param Request $request
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createNextRowAfterResult(ObjectManager $manager,
                                             Request $request,
                                             SessionInterface $session,
                                             CompetitionRepository $cr,
                                             DanceRepository $dr,
                                             TeamRepository $tr,
                                             CategoryRepository $catr,
                                             RowRepository $rr){
        $parametersAsArray = array();
        if ($content = $request->getContent()){
            $parametersAsArray = json_decode($content, true);
        }

        $numTour=$parametersAsArray['nextRound'];

        $idCompetition=$session->get('competSelected');
        $competition=$cr->find($idCompetition);

        $idRow = $parametersAsArray['rowId'];
        $row = $rr->find($idRow);
        $row->setIsDone(true);
        $dance = $row->getDance();
        $category = $row->getCategory();
        $formation = $row->getFormation();
        $piste = $row->getPiste();
        $passageSimul = $row->getPassageSimul();
        $nbJudge = $row->getNbJudge();
        $nbTeamsChoosen = $parametersAsArray['nbQualifie'];
        $row->setNbChoosen($nbTeamsChoosen);
        $notes = $parametersAsArray['notes'];

        arsort($notes);

        //Creation d'entités Resultat
        foreach ($notes as $idTeam =>$note){
            $resultat = new Resultat();
            $teamNotes = $tr->findOneBy(['numDossard'=>$idTeam]);
            $resultat->setNote($note)
                ->setTeam($teamNotes)
                ->setRow($row)
                ->setNbGardes($nbTeamsChoosen)
            ;
            $manager->persist($resultat);
        }
        $manager->flush();

        $teamsForNextRound = [];
        for ($i = 0; $i<$nbTeamsChoosen; $i++){
            $maxVal = $this->array_kshift($notes);
            $teamsForNextRound[array_keys($maxVal)[0]]=array_values($maxVal)[0];
        }
        dump($teamsForNextRound);
        $newRow=new Row();

        $newRow
            ->setDance($dance)
            ->setCategory($category)
            ->setFormation($formation)
            ->setPiste($piste)
            ->setIsDone(false)
            ->setCompetition($competition)
            ->setNbJudge($nbJudge)
            ->setPassageSimul($passageSimul);

        //ajout des équipes
        $idDesEquipes = array_keys($teamsForNextRound);
        foreach ($idDesEquipes as $idEquipe){
            dump($idEquipe);
            $equipe = $tr->findOneBy(['numDossard'=>$idEquipe]);
            dump($equipe);
            $newRow->addTeam($equipe);
        }
        if (sizeof($idDesEquipes) == 2){
            $newRow->setNumTour("Finale");
        }else{
            $newRow->setNumTour($numTour);
        }
        $manager->persist($newRow);
        $manager->flush();

        return $this->json(['res' => 'YESSS']);
    }

    /**
     * @Route("/row/getAllTeamById", name="Row.getAllTeamById", methods={"GET"})
     * @param RowRepository $rowRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
	public function getAllTeamByRowId(RowRepository $rowRepository) {
		$row = $rowRepository->find($_GET['id']);
		$teams = $row->getTeams();
		$numTeams = [];

		foreach ($teams as $team){
			array_push($numTeams,$team->getNumDossard());
		}
		return $this->json(["Res"=>$numTeams]);
    }
}
