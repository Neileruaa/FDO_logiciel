<?php

namespace App\Repository;

use App\Entity\Competition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Competition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Competition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Competition[]    findAll()
 * @method Competition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Competition::class);
    }

    public function getRows($idCompet){
        $entityManager = $this->getEntityManager();
        return $this->createQueryBuilder('c')
            ->select('cd.nameDance, cat.nameCategory, ct.size, 1 as round, 1 as piste')
            ->andWhere('c.id = :idCompet')
            ->andWhere('cd.id = td.id')
            ->join("c.dances", "cd")
            ->join("c.teams", "ct")
            ->join("ct.dances", "td")
            ->join("ct.category", "cat")
            ->setParameter('idCompet', $idCompet)
            ->distinct("d.nameDance, cat.nameCategory, ct.size")
            ->getQuery()
            ->getResult()
            ;
    }

//    /**
//     * @return Competition[] Returns an array of Competition objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Competition
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
