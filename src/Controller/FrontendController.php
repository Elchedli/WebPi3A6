<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/front")
 */
class FrontendController extends AbstractController
{

    /**
     * @Route("/", name="acceuil", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('Frontend/acceuil.html.twig');
    }
    /**
     * @Route("/article", name="article", methods={"GET"})
     */
    public function article(): Response
    {
        return $this->render('Frontend/article.html.twig');
    }
    /**
     * @Route("/client", name="client", methods={"GET"})
     */
    public function client(): Response
    {
        return $this->render('Frontend/client.html.twig');
    }
    /**
     * @Route("/discussion", name="discussion", methods={"GET"})
     */
    public function discussion(): Response
    {
        return $this->render('Frontend/discussion.html.twig');
    }
    /**
     * @Route("/evenement", name="event", methods={"GET"})
     */
    public function event(): Response
    {
        return $this->render('Frontend/event.html.twig');
    }
    /**
     * @Route("/publication", name="publication", methods={"GET"})
     */
    public function publication(): Response
    {
        return $this->render('Frontend/publication.html.twig');
    }
    /**
     * @Route("/reclamation", name="reclamation", methods={"GET"})
     */
    public function reclamation(): Response
    {
        return $this->render('Frontend/reclamation.html.twig');
    }

}
