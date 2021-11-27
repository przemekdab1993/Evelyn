<?php

namespace App\Repository;

use App\Entity\VotePoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VotePoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method VotePoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method VotePoint[]    findAll()
 * @method VotePoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotePointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VotePoint::class);
    }

    // /**
    //  * @return VotePoint[] Returns an array of VotePoint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VotePoint
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
