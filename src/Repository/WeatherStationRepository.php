<?php

namespace App\Repository;

use App\Entity\WeatherStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WeatherStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherStation[]    findAll()
 * @method WeatherStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherStation::class);
    }

    // /**
    //  * @return WeatherStation[] Returns an array of WeatherStation objects
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
    public function findOneBySomeField($value): ?WeatherStation
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
