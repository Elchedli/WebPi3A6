<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateEventController extends AbstractController
{
    /**
     * @Route("/template/event", name="template_event")
     */
    public function index(): Response
    {
        return $this->render('template_event/index.html.twig', [
            'controller_name' => 'TemplateEventController',
        ]);
    }
}
