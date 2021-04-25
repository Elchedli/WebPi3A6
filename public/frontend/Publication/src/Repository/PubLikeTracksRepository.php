<?php

namespace App\Repository;

use App\Entity\PubLikeTracks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PubLikeTracks|null find($id, $lockMode = null, $lockVersion = null)
 * @method PubLikeTracks|null findOneBy(array $criteria, array $orderBy = null)
 * @method PubLikeTracks[]    findAll()
 * @method PubLikeTracks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PubLikeTracksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PubLikeTracks::class);
    }

    public function IsLiked($id_pub,$id_user)
    {
//        $user = "mgkpsy";
        $sql = 'select c from App:PubLikeTracks c where c.id_pub = :id_pub AND c.id_user = :id_user';
        $result = $this->getEntityManager()->createQuery($sql)->setParameters(array('id_pub'=>$id_pub,'id_user'=>$id_user));

        if(sizeof($result->getResult())==0)
        {
            return false;
        }
        else
            return true;
    }

    public function t()
    {

    }


}
