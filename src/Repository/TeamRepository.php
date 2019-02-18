<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function getTeamsByCat($nameDance, $nameCat, $size, $comp){
        return $this->createQueryBuilder('t')
            ->select('t.id')
            ->andWhere('td.nameDance = :nameDance')
            ->andWhere('tc.nameCategory = :nameCat')
            ->andWhere('t.isPresent=true')
            ->andWhere('t.size = :size')
            ->andWhere('tco.id =:compet')
            ->join('t.dances', 'td')
            ->join('t.category', 'tc')
            ->join('t.competitions','tco')
            ->setParameter('nameDance', $nameDance)
            ->setParameter('nameCat', $nameCat)
            ->setParameter('size', $size)
            ->setParameter('compet',$comp)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Team[] Returns an array of Team objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Team
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
