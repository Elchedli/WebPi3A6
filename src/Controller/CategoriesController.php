<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="categories_index", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('Front/categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="categories_new", methods={"GET","POST"})
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
            return $this->redirectToRoute('categories_index');
        }

        return $this->render('Front/categories/add.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCat}", name="categories_show", methods={"GET"})
     */
    public function show(Categories $categories): Response
    {
        return $this->render('Front/categories/show.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{idCat}/edit", name="categories_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categories $category): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_index');
        }

        return $this->render('Front/categories/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCat}", name="categories_delete", methods={"POST"})
     */
    public function delete(Request $request, Categories $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getIdCat(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_index');
    }
}
