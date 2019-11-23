<?php

namespace App\Repository;

use App\Entity\Gonderi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gonderi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gonderi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gonderi[]    findAll()
 * @method Gonderi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GonderiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gonderi::class);
    }
    /**
     * @return Gonderi[]
     */
    public function sondanvericek($sinir,$baslangic): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT g
            FROM App\Entity\Gonderi g
            ORDER BY g.id DESC
            '
        )->setMaxResults($sinir)->setFirstResult($baslangic);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
     * @return Gonderi[]
     */
    public function sayfalama($sayfa): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT g
            FROM App\Entity\Gonderi g
            ORDER BY g.id DESC 
            '
        )->setMaxResults(8)->setFirstResult(((8 * $sayfa)-8));

        // returns an array of Product objects
        return $query->getResult();
    }
    /**
     * @return Gonderi[]
     */
    public function kategoriler(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT g.kategori AS kategori,count(g.id) AS sayi
            FROM App\Entity\Gonderi g
            GROUP BY g.kategori
            order by count(g.id) DESC 
            '
        );

        // returns an array of Product objects
        return $query->execute();
    }

    // /**
    //  * @return Gonderi[] Returns an array of Gonderi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gonderi
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
