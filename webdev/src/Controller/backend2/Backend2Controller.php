<?php

namespace App\Controller\backend2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/backend2")
 */
class Backend2Controller extends AbstractController
{
    /**
     * @Route("/", name="acceuilback2")
     */
    public function index(): Response{
        return $this->render('backend2/index.html.twig', [
            'controller_name' => 'Backend2Controller',
        ]);
    }
}
