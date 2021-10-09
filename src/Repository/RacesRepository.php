<?php

namespace App\Repository;

use App\Entity\Races;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Races|null find($id, $lockMode = null, $lockVersion = null)
 * @method Races|null findOneBy(array $criteria, array $orderBy = null)
 * @method Races[]    findAll()
 * @method Races[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RacesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Races::class);
    }

    // /**
    //  * @return Races[] Returns an array of Races objects
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
    public function findOneBySomeField($value): ?Races
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getRaces()
    {
        $query =  $this->createQueryBuilder('r')
            ->select('r.name','r.id');
        return $query->getQuery()->execute();
    }
}
