<?php

namespace App\Repository;

use App\Entity\Publication;
use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publication|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publication|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publication[]    findAll()
 * @method Publication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publication::class);
    }
    public function Like($id_pub)
    {
//        $user = "mgkpsy";
        $sql = 'update App:Publication c SET c.nb_reaction = c.nb_reaction+1 where c.id_pub = :id_pub';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('id_pub', $id_pub);
        return $result->getResult();
    }
    public function Dislike($id_pub)
    {
//        $user = "mgkpsy";
        $sql = 'update App:Publication c SET c.nb_reaction = c.nb_reaction-1 where c.id_pub = :id_pub';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('id_pub', $id_pub);
        return $result->getResult();
    }

}
