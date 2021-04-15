<?php

namespace App\Controller\backend;
use App\Entity\Suivi;
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
    public function backsuivi(): Response
    {
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
    public function backtaches(): Response
    {
        return $this->render('backend/taches.html.twig');
    }
}
