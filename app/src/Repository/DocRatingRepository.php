<?php

namespace App\Repository;

use App\Entity\DocRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocRating[]    findAll()
 * @method DocRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocRating::class);
    }

     /**
      * @return DocRating[] Returns an array of DocRating objects
      */

    public function findByDocId($docId)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.docId = :docId')
            ->setParameter('docId', $docId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?DocRating
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
