<?php

namespace App\Repository;

use App\Entity\Resultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Resultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resultat[]    findAll()
 * @method Resultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Resultat::class);
    }

    public function findByRow($idRow){
        return $this->createQueryBuilder('r')
            ->andWhere('r.row = :row')
            ->setParameter('row', $idRow)
            ->orderBy('r.note','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getResultsFromRow($r){
        return $this->createQueryBuilder('r')
            ->andWhere('r.row=:row')
            //->andWhere('r.team=:team')
            ->setParameter("row",$r)
            //->setParameter("team",$t)
            ->orderBy('r.note','ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Resultat[] Returns an array of Resultat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Resultat
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
