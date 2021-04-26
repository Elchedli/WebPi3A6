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
 * @Route("/nutrifront")
 */
class NutriControllerFront extends AbstractController
{
    /**
     * @Route("/", name="nutrifront_index", methods={"GET"})
     */
    public function index(NutriRepository $NutriRepository): Response
    {
        return $this->render('nutrifront/index.html.twig', [
            'nutris' => $NutriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nutrifront_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Nutri = new Nutri();
        $form = $this->createForm(NutriType::class, $Nutri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Nutri);
            $entityManager->flush();

            return $this->redirectToRoute('nutrifront_index');
        }

        return $this->render('nutrifront/new.html.twig', [
            'Nutri' => $Nutri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nutrifront_show", methods={"GET"})
     */
    public function show(Nutri $Nutri): Response
    {
        return $this->render('nutrifront/show.html.twig', [
            'Nutri' => $Nutri,
        ]);
    }

    /**
     * @Route("/{id_user}/edit", name="nutrifront_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Nutri $Nutri): Response
    {
        $form = $this->createForm(NutriType::class, $Nutri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nutrifront_index');
        }

        return $this->render('nutrifront/edit.html.twig', [
            'Nutri' => $Nutri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_user}", name="nutrifront_delete", methods={"POST"})
     */
    public function delete(Request $request, nutri $Nutri): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Nutri->getIduser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Nutri);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nutrifront_index');
    }
}
