<?php
namespace App\Repository;
use App\Entity\login;
use App\Entity\Suivi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method Suivi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Suivi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Suivi[]    findAll()
 * @method Suivi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,SessionInterface $session){
        $this->session = $session;
        parent::__construct($registry, Suivi::class);
    }

    public function afficher(){
        $sql = 'select s from App:Suivi s where s.username = :username';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('username', $this->session->get("user"));
        return $result->getResult();
    }

    public function SuiviNom($idS)
    {
        $sql = 'select s.titreS from App:Suivi s where s.idS = :id';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('id', $idS);
        return $result->getResult();
    }
    public function SuiviTaches($user)
    {
//        $sql = 'select distinct t.username,s.idS from App:Tache t join App:Suivi s where t.username = s.client';
        $sql = 'select s from App:Suivi s where s.client = :user';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('user', $user);
        return $result->getResult();
    }

    public function SuiviClients()
    {
//        $sql = 'select distinct t.username,s.idS from App:Tache t join App:Suivi s where t.username = s.client';
        $sql = 'select distinct s.client from App:Suivi s where s.username = :user';
        $result = $this->getEntityManager()->createQuery($sql)->setParameter('user', $this->session->get("user"));
        return $result->getResult();
    }

    public function SuiviSelect($client){
        $parameters = array(
            'user' => $this->session->get("user"),
            'client' => $client
        );
//        $sql = 'select distinct t.username,s.idS from App:Tache t join App:Suivi s where t.username = s.client';
        $sql = 'select s from App:Suivi s where s.username = :user and s.client = :client';
        $result = $this->getEntityManager()->createQuery($sql)->setParameters($parameters);
        return $result->getResult();
    }

    public function verifieruser(login $user,string $type){
        $pass = utf8_encode($user->getPassword());
        $sql = "";
        $parameters = array(
            'username' => $user->getUsername(),
            'password' => $user->getPassword()
        );
        switch ($type) {
            case 'simple':
                $sql = "select s.username from App:Simple s where s.username = :username AND s.password = :password";
                break;
            case 'psycho':
                $sql = "select s.username from App:Psycho s where s.username = :username AND s.password = :password";
                break;
            case 'coach':
                $sql = "select s.username from App:Coach s where s.username = :username AND s.password = :password";
                break;
            case 'nutri':
                $sql = "select s.username from App:Nutri s where s.username = :username AND s.password = :password";
                break;
        }
        $result = $this->getEntityManager()->createQuery($sql)->setParameters($parameters);
        if($result->getResult()) return true;
        return false;
    }
}
