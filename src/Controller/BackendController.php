<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categorie;
use App\Form\ArticlesType;
use App\Form\Categorie1Type;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('Backend/index.html.twig');
    }
    /**
     * @Route("/articles", name="articles_indexx", methods={"GET"})
     */
    public function indexArt(ArticleRepository $articleRepository): Response
    {
        return $this->render('Backend/articles/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/articles/{idArt}", name="articles_showw", methods={"GET"})
     */
    public function show(Articles $article): Response
    {
        return $this->render('Backend/articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/categorie", name="categorie_indexx", methods={"GET"})
     */
    public function indexCat(CategorieRepository $categorieRepository): Response
    {
        return $this->render('Backend/categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }
    /**
     * @Route("/categorie/new", name="categorie_neww", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(Categorie1Type::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('Backend/categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categorie/{idCat}", name="categorie_showw", methods={"GET"})
     */
    public function showCat(Categorie $categorie): Response
    {
        return $this->render('Backend/categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/categorie/{idCat}/edit", name="categorie_editt", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(Categorie1Type::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('Backend/categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categorie/{idCat}", name="categorie_deletee", methods={"POST"})
     */
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getIdCat(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }






}
