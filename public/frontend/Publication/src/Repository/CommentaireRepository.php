<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    public function AffichageComment($pub)
    {
//        $user = "mgkpsy";
        $sql = 'select c from App:Commentaire c where c.id_pub = :publication';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('publication', $pub);
        return $result->getResult();
    }
}
