<?php

namespace App\Repository;

use App\Entity\SalesforceContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SalesforceContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalesforceContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalesforceContact[]    findAll()
 * @method SalesforceContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalesforceContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalesforceContact::class);
    }

    // /**
    //  * @return SalesforceContact[] Returns an array of SalesforceContact objects
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
    public function findOneBySomeField($value): ?SalesforceContact
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
