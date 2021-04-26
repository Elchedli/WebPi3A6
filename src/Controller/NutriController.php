<?php

namespace App\Controller;

use App\Entity\Nutri;
use App\Form\NutriType;
use App\Repository\NutriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nutri")
 */
class NutriController extends AbstractController
{
    /**
     * @Route("/", name="nutri_index", methods={"GET"})
     */
    public function index(NutriRepository $nutriRepository): Response
    {
        return $this->render('nutri/index.html.twig', [
            'nutris' => $nutriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nutri_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nutri = new Nutri();
        $form = $this->createForm(NutriType::class, $nutri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nutri);
            $entityManager->flush();

            return $this->redirectToRoute('nutri_index');
        }

        return $this->render('nutri/new.html.twig', [
            'nutri' => $nutri,
            'nutri' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nutri_show", methods={"GET"})
     */
    public function show(Nutri $nutri): Response
    {
        return $this->render('nutri/show.html.twig', [
            'nutri' => $nutri,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nutri_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Nutri $nutri): Response{
        $form = $this->createForm(NutriType::class, $nutri);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('nutri_index');
        }

        return $this->render('nutri/edit.html.twig', [
            'nutri' => $nutri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nutri_delete", methods={"POST"})
     */
    public function delete(Request $request, Nutri $nutri): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nutri->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nutri);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nutri_index');
    }
}
