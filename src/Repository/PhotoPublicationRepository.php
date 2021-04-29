<?php

namespace App\Repository;

use App\Entity\PhotoPublication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoPublication|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoPublication|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoPublication[]    findAll()
 * @method PhotoPublication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoPublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoPublication::class);
    }

    // /**
    //  * @return PhotoPublication[] Returns an array of PhotoPublication objects
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
    public function findOneBySomeField($value): ?PhotoPublication
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
