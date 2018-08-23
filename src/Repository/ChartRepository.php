<?php

namespace App\Repository;

use App\Entity\Chart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Chart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chart[]    findAll()
 * @method Chart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chart::class);
    }

    /**
     * @return Chart[] Returns an array of Chart objects
     */
    public function findByLabel($label)
    {
        return $this->createQueryBuilder('c')
            ->join('c.chartLabels', 'cl')
            ->andWhere('cl.name = :label')
            ->setParameter('label', $label)
            ->getQuery()
            ->execute()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Chart
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
