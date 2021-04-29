<?php

namespace App\Controller;

use App\Entity\Psycho;
use App\Form\PsychoType;
use App\Repository\PsychoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Psychofront")
 */
class PsychoControllerFront extends AbstractController
{
    /**
     * @Route("/", name="Psychofront_index", methods={"GET"})
     */
    public function index(PsychoRepository $PsychoRepository): Response
    {
        return $this->render('Psychofront/index.html.twig', [
            'Psychos' => $PsychoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Psychofront_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Psycho = new Psycho();
        $form = $this->createForm(PsychoType::class, $Psycho);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Psycho);
            $entityManager->flush();

            return $this->redirectToRoute('Psychofront_index');
        }

        return $this->render('Psychofront/new.html.twig', [
            'Psycho' => $Psycho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Psychofront_show", methods={"GET"})
     */
    public function show(Psycho $Psycho): Response
    {
        return $this->render('Psychofront/show.html.twig', [
            'Psycho' => $Psycho,
        ]);
    }

    /**
     * @Route("/{id_user}/edit", name="Psychofront_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Psycho $Psycho): Response
    {
        $form = $this->createForm(PsychoType::class, $Psycho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Psychofront_index');
        }

        return $this->render('Psychofront/edit.html.twig', [
            'Psycho' => $Psycho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_user}", name="Psychofront_delete", methods={"POST"})
     */
    public function delete(Request $request, Psycho $Psycho): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Psycho->getIduser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Psycho);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Psychofront_index');
    }
}
