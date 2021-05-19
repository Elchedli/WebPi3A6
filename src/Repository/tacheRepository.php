<?php
namespace App\Repository;
use App\Entity\Suivi;
use App\Entity\Tache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tache|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tache[]    findAll()
 * @method Tache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }

    public function AffichageClients()
    {
        $user = "mgkpsy";
//        $sql = 'select distinct t.username,s.idS from App:Tache t join App:Suivi s where t.username = s.client';
        $sql = 'select distinct s from App:Suivi s where s.username = :user';
        $result = $this->getEntityManager()->createQuery($sql)->getResult()->setParameter('user', $user);
        return $result;
    }

    // n'oublie pas de verifier cela
    public function chercherTaches($idS){
        $idS = "shidono";
        $sql = 'select t from App:Tache t where t.username = :id';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('id', $idS);
        return $result->getResult();
    }

    public function TachesToDo($client,$idS){
        $sql = 'select t from App:Tache t where t.username = :user';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('user', $client);
        return $result->getResult();
    }

    public function changer(Tache $suivi){
        $parameters = array(
            'id' => $suivi->getIdTache(),
            'username' => $suivi->getUsername(),
            'etat' => $suivi->getEtatTache(),
            'difficulte' => $suivi->getDifficulteTache(),
            'description' => $suivi->getDescriptionTache()
        );
        $sql = 'update App:Tache t set t.username = :username,t.etat = :etat,s.difficulteTache = :difficulte,t.descriptionTache = :description where s.idTache = :id';
        $result = $this->getEntityManager()->createQuery($sql)->setParameters($parameters);
        return $result->getResult();
    }



}
