<?php

namespace App\Controller\backend;
use App\Entity\Suivi;
use App\Entity\Tache;
use App\Repository\TacheRepository;
use App\Repository\SuiviRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/backend")
 */
class BackendController extends AbstractController
{
    /**
     * @Route("/", name="back", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('backend/acceuil.html.twig');
    }

    /**
     * @Route("/backsuivi", name="backsuivi", methods={"GET","POST"})
     */
    public function backsuivi(){
        $suivis = $this->getDoctrine()
            ->getRepository(Suivi::class)
            ->findAll();

        return $this->render('backend/suivi.html.twig', [
            'suivis' => $suivis,
        ]);
    }

    /**
     * @Route("/backtaches", name="backtaches", methods={"GET"})
     */
    public function backtaches(){
        $em=$this->getDoctrine()->getManager();
        $data = $em->getRepository( Suivi::class)->SuiviClients();
        return $this->render('tache/client.html.twig', [
            'clients' => $data,
        ]);
    }
}
