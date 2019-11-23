<?php

namespace App\Repository;

use App\Entity\Yorumlar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Yorumlar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yorumlar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yorumlar[]    findAll()
 * @method Yorumlar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YorumlarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yorumlar::class);
    }

    /**
     * @return Yorumlar[]
     */
    public function yorumlar(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT y.yorumid AS yorum,count(y.id) AS sayi
            FROM App\Entity\Yorumlar y
            GROUP BY y.yorumid
            order by count(y.id) DESC 
            '
        );

        // returns an array of Product objects
        return $query->execute();
    }

    /**
     * @return Yorumlar[]
     */
    public function populer(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT y.yorumid AS yorum,count(y.id) AS sayi
            FROM App\Entity\Yorumlar y
            GROUP BY y.yorumid
            order by count(y.id) DESC 
            '
        )->setMaxResults(4);

        // returns an array of Product objects
        return $query->execute();
    }


    // /**
    //  * @return Yorumlar[] Returns an array of Yorumlar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yorumlar
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
