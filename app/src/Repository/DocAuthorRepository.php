<?php

namespace App\Repository;

use App\Entity\DocAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocAuthor[]    findAll()
 * @method DocAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocAuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocAuthor::class);
    }

    // /**
    //  * @return DocAuthor[] Returns an array of DocAuthor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocAuthor
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
