<?php

namespace App\Repository;

use App\Entity\Psy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Psy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Psy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Psy[]    findAll()
 * @method Psy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Psy::class);
    }

    // /**
    //  * @return Psy[] Returns an array of Psy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Psy
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
