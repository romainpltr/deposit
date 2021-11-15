<?php

namespace App\Repository;

use App\Entity\WorkCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkCategory[]    findAll()
 * @method WorkCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkCategory::class);
    }

    // /**
    //  * @return WorkCategory[] Returns an array of WorkCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkCategory
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
