<?php

namespace App\Repository;

use App\Entity\Dance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dance[]    findAll()
 * @method Dance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dance::class);
    }

//    /**
//     * @return Dance[] Returns an array of Dance objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dance
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
