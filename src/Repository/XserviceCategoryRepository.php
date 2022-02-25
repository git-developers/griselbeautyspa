<?php

namespace App\Repository;

use App\Entity\XserviceCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XserviceCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method XserviceCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method XserviceCategory[]    findAll()
 * @method XserviceCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XserviceCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XserviceCategory::class);
    }

    // /**
    //  * @return XserviceCategory[] Returns an array of XserviceCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?XserviceCategory
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
