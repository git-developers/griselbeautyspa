<?php

namespace App\Repository;

use App\Entity\Xservice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Xservice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Xservice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Xservice[]    findAll()
 * @method Xservice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XserviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Xservice::class);
    }

    public function findAll()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Xservice p
            WHERE p.isEnabled = :isEnabled
            ORDER BY p.id DESC'
        )
            ->setParameter('isEnabled', true);

        return $query->getResult();
    }

    public function isServiceCategoryUsed($xServiceCategoryId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.id
            FROM App\Entity\Xservice p
            WHERE p.xServiceCategory = :xServiceCategoryId
            ORDER BY p.id DESC'
        )
            ->setParameter('xServiceCategoryId', $xServiceCategoryId);

        return (count($query->getResult()) > 0) ? true : false;
    }

    // /**
    //  * @return Xservice[] Returns an array of Xservice objects
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
    public function findOneBySomeField($value): ?Xservice
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
