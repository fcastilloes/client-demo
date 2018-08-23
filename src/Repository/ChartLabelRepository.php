<?php

namespace App\Repository;

use App\Entity\ChartLabel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChartLabel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChartLabel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChartLabel[]    findAll()
 * @method ChartLabel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartLabelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChartLabel::class);
    }

//    /**
//     * @return ChartLabel[] Returns an array of ChartLabel objects
//     */
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
    public function findOneBySomeField($value): ?ChartLabel
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
