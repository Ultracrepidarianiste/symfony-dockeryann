<?php

namespace App\Repository;

use App\Entity\Title1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Title1>
 *
 * @method Title1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Title1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Title1[]    findAll()
 * @method Title1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Title1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Title1::class);
    }

    //    /**
    //     * @return Title1[] Returns an array of Title1 objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Title1
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
