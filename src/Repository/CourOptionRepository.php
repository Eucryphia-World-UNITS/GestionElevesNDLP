<?php

namespace App\Repository;

use App\Entity\CourOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CourOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourOption[]    findAll()
 * @method CourOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourOption::class);
    }

    // /**
    //  * @return CourOption[] Returns an array of CourOption objects
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
    public function findOneBySomeField($value): ?CourOption
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
