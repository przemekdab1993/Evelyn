<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public static function createApprovedCriteria():Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('status',Comment::STATUS_APPROVED));
    }

    public function findAllApprovedComments($max = 10):array
    {
        return $this->createQueryBuilder('c')
            ->addCriteria(self::createApprovedCriteria())
            ->setMaxResults($max)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function findMostPopularListComment(string $search = null): array
    {
        $queryBuilder =  $this->createQueryBuilder('comment')
            ->addCriteria(self::createApprovedCriteria())
            ->orderBy('comment.vote', 'DESC')
            ->innerJoin('comment.doc', 'doc')
            ->addSelect('doc')
            ->innerJoin('doc.docRating', 'rating')
            ->addSelect('rating')
            ->setMaxResults(10);

        if (!empty($search)) {
            $queryBuilder
                ->andWhere('comment.comment LIKE :search OR doc.title LIKE :search')
                ->setParameter(':search', '%'.$search.'%');
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
