<?php

namespace App\Controller\frontend;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @Route("/frontend")
 */
class FrontendController extends AbstractController
{
    /**
     * FrontendController constructor.
     */
    public function __construct(SessionInterface $session){
        $this->session = $session;
    }

    /**
     * @Route("/", name="acceuil", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('frontend/acceuil.html.twig');
    }
    /**
     * @Route("/article", name="article", methods={"GET"})
     */
    public function article(): Response
    {
        return $this->render('frontend/article.html.twig');
    }
    /**
     * @Route("/client", name="client", methods={"GET"})
     */
    public function client(): Response
    {
        return $this->render('frontend/client.html.twig');
    }
    /**
     * @Route("/discussion", name="discussion", methods={"GET"})
     */
    public function discussion(): Response
    {
        return $this->render('frontend/discussion.html.twig');
    }
    /**
     * @Route("/evenement", name="event", methods={"GET"})
     */
    public function event(): Response
    {
        return $this->render('frontend/event.html.twig');
    }
    /**
     * @Route("/publication", name="publication", methods={"GET"})
     */
    public function publication(): Response
    {
        return $this->render('frontend/publication.html.twig');
    }
    /**
     * @Route("/reclamation", name="reclamation", methods={"GET"})
     */
    public function reclamation(): Response
    {
        return $this->render('frontend/reclamation.html.twig');
    }

    /**
     * @Route("/suivi", name="fsuivi", methods={"GET"})
     */
    public function fsuivi(): Response
    {
        return $this->render('frontend/suivi.html.twig');
    }

}
