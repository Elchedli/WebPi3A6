<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('template_event/backtest.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * @Route("/{idEv}/show", name="evenement_showAA", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/showAdmin.html.twig', [
            'evenement' => $evenement,
        ]);
    }
}

