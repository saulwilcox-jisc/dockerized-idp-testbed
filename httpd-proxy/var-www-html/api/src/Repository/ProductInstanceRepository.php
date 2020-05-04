<?php

namespace App\Repository;

use App\Entity\ProductInstance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductInstance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductInstance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductInstance[]    findAll()
 * @method ProductInstance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductInstanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductInstance::class);
    }

    // /**
    //  * @return ProductInstance[] Returns an array of ProductInstance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductInstance
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
