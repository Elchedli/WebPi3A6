<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method Reclamation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamation[]    findAll()
 * @method Reclamation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,SessionInterface $session){
        $this->session = $session;
        parent::__construct($registry, Reclamation::class);
    }

    public function afficher(){
        $sql = 'select s from App:reclamation s where s.username = :username';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('username', $this->session->get("user"));
        return $result->getResult();
    }

}