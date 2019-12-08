<?php

namespace App\Repository;

use App\Entity\SoftwareVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SoftwareVersion|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoftwareVersion|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoftwareVersion[]    findAll()
 * @method SoftwareVersion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoftwareVersionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoftwareVersion::class);
    }

    // /**
    //  * @return SoftwareVersion[] Returns an array of SoftwareVersion objects
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
    public function findOneBySomeField($value): ?SoftwareVersion
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
