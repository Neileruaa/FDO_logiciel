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

    public function findByIsDone(){
    	return $this->createQueryBuilder('r')
		    ->andWhere('r.isDone = :val')
		    ->setParameter('val', true)
		    ->getQuery()
		    ->getResult()
	    ;
    }

	public function findToDoRow(){
		return $this->createQueryBuilder('r')
			->andWhere('r.isDone = :val')
			->setParameter('val', false)
			->orderBy('r.position')
			->getQuery()
			->getResult()
			;
	}

	public function findRowsOrderedByPosition(){
		return $this->createQueryBuilder('r')
			->andWhere('r.isDone = :val')
			->setParameter('val', false)
			->orderBy('r.position')
			->getQuery()
			->getResult()
			;
	}

	public function findSameRows($dance, $cat,$form,$val){
        return $this->createQueryBuilder('r')
            ->andWhere('r.dance =:dance')
            ->andWhere('r.category =:cat')
            ->andWhere('r.formation =:form')
            ->andWhere('r.nbChoosen !=:val')
            ->setParameter('dance',$dance)
            ->setParameter('cat',$cat)
            ->setParameter('form',$form)
            ->setParameter('val',$val)
            ->getQuery()
            ->getResult();
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
