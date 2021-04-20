<?php
namespace App\Repository;
use App\Entity\Suivi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Suivi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Suivi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Suivi[]    findAll()
 * @method Suivi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Suivi::class);
    }

    public function SuiviClients()
    {
        $user = "mgkpsy";
//        $sql = 'select distinct t.username,s.idS from App:Tache t join App:Suivi s where t.username = s.client';
        $sql = 'select distinct s.client from App:Suivi s where s.username = :user';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('user', $user);
        return $result->getResult();
    }

    public function SuiviSelect($client){
        $user = "mgkpsy";
        $parameters = array(
            'user' => $user,
            'client' => $client
        );
//        $sql = 'select distinct t.username,s.idS from App:Tache t join App:Suivi s where t.username = s.client';
        $sql = 'select s from App:Suivi s where s.username = :user and s.client = :client';
        $result = $this->getEntityManager()->createQuery($sql)->setParameters($parameters);
        return $result->getResult();
    }
}
