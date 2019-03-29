<?php

namespace App\Repository;

use App\Entity\Sauvegarde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sauvegarde|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sauvegarde|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sauvegarde[]    findAll()
 * @method Sauvegarde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SauvegardeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sauvegarde::class);
    }

    // /**
    //  * @return Sauvegarde[] Returns an array of Sauvegarde objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sauvegarde
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
