<?php

namespace App\Repository;

use App\Entity\Row;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Row|null find($id, $lockMode = null, $lockVersion = null)
 * @method Row|null findOneBy(array $criteria, array $orderBy = null)
 * @method Row[]    findAll()
 * @method Row[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Row::class);
    }

    // /**
    //  * @return Row[] Returns an array of Row objects
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
    public function findOneBySomeField($value): ?Row
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
