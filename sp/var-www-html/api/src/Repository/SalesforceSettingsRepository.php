<?php

namespace App\Repository;

use App\Entity\SalesforceSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SalesforceSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalesforceSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalesforceSettings[]    findAll()
 * @method SalesforceSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalesforceSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalesforceSettings::class);
    }

    // /**
    //  * @return SalesforceSettings[] Returns an array of SalesforceSettings objects
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
    public function findOneBySomeField($value): ?SalesforceSettings
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
