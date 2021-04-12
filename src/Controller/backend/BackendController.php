<?php

namespace App\Controller\backend;
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
}
