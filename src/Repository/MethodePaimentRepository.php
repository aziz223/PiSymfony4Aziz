<?php

namespace App\Repository;

use App\Entity\MethodePaiment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MethodePaiment|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodePaiment|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodePaiment[]    findAll()
 * @method MethodePaiment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodePaimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MethodePaiment::class);
    }

    // /**
    //  * @return MethodePaiment[] Returns an array of MethodePaiment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MethodePaiment
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
