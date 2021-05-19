<?php

namespace App\Controller\backend2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/backend2")
 */
class Backend2Controller extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/", name="acceuilback2")
     */
    public function index(): Response{
        if(!in_array($this->session->get('type'),['psycho','coach','nutri'])){
            $this->session->set('user','');
        }
        return $this->render('backend2/index.html.twig', [
            'controller_name' => 'Backend2Controller',
        ]);
    }
}
