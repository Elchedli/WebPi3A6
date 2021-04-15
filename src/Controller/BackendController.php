<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Reclamation;
use App\Form\CategoriesType;
use App\Form\ReclamationType;
use App\Repository\CategoriesRepository;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackendController extends AbstractController
{
    /**
     * @Route("/backend", name="backend")
     */

    /**
     * @Route("/backend/cat", name="categories_indexx", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('Back/categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/backend/cat/add", name="categories_neww", methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        $categories= new Categories();
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories);
            $em->flush();
            return $this->redirectToRoute('categories_indexx');
        }

        return $this->render('Back/categories/add.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("//backend/cat/{idCat}", name="categories_showw", methods={"GET"})
     */
    public function show(Categories $categories): Response
    {
        return $this->render('Back/categories/show.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/backend/cat/{idCat}/edit", name="categories_editt", methods={"GET","POST"})
     */
    public function edit(Request $request, Categories $categories): Response
    {
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_indexx');
        }

        return $this->render('Back/categories/edit.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/backend/cat/{idCat}", name="categories_deletee", methods={"POST"})
     */
    public function delete(Request $request, Categories $categories): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categories->getIdCat(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categories);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_indexx');
    }

    /**
     * @Route("/backend/rec", name="reclamation_indexx", methods={"GET"})
     */
    public function indexRec(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('Back/reclamation/index.html.twig', [
            'reclamation' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/backend/rec/{idRec}", name="reclamation_showw", methods={"GET"})
     */
    public function showRec(Reclamation $reclamation): Response
    {
        return $this->render('Back/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/backend/rec/{idRec}/edit", name="reclamation_editt", methods={"GET","POST"})
     */
    public function editRec(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_indexx');
        }

        return $this->render('Back/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/backend/rec/{idRec}", name="reclamation_deletee", methods={"POST"})
     */
    public function deleteRec(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdRec(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_indexx');

    }
}
