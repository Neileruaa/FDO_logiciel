<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Row;
use App\Entity\Team;
use App\Repository\CategoryRepository;
use App\Repository\CompetitionRepository;
use App\Repository\DanceRepository;
use App\Repository\RowRepository;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
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

        $rows=$rr->findBy(['competition'=>$compet]);
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
            //dump($row);
            $dance=$dr->findBy(['nameDance'=>$row['nameDance']]);
            $newRow->setDance($dance[0]);

            $newRow->setNumTour("1");

            $category=$catr->findBy(['nameCategory'=>$row['nameCategory']]);
            $newRow->setCategory($category[0]);

            $newRow->setFormation($row['size']);

            $teams=$tr->getTeamsByCat($row['nameDance'], $row['nameCategory'], $row['size']);
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
}
