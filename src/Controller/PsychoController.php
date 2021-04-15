<?php

namespace App\Controller;

use App\Entity\Psycho;
use App\Form\PsychoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/psycho")
 */
class PsychoController extends AbstractController
{
    /**
     * @Route("/", name="psycho_index", methods={"GET"})
     */
    public function index(): Response
    {
        $psychos = $this->getDoctrine()
            ->getRepository(Psycho::class)
            ->findAll();

        return $this->render('psycho/index.html.twig', [
            'psychos' => $psychos,
        ]);
    }

    /**
     * @Route("/new", name="psycho_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $psycho = new Psycho();
        $form = $this->createForm(PsychoType::class, $psycho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($psycho);
            $entityManager->flush();

            return $this->redirectToRoute('psycho_index');
        }

        return $this->render('psycho/new.html.twig', [
            'psycho' => $psycho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}", name="psycho_show", methods={"GET"})
     */
    public function show(Psycho $psycho): Response
    {
        return $this->render('psycho/show.html.twig', [
            'psycho' => $psycho,
        ]);
    }

    /**
     * @Route("/{idUser}/edit", name="psycho_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Psycho $psycho): Response
    {
        $form = $this->createForm(PsychoType::class, $psycho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('psycho_index');
        }

        return $this->render('psycho/edit.html.twig', [
            'psycho' => $psycho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}", name="psycho_delete", methods={"POST"})
     */
    public function delete(Request $request, Psycho $psycho): Response
    {
        if ($this->isCsrfTokenValid('delete'.$psycho->getIdUser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($psycho);
            $entityManager->flush();
        }

        return $this->redirectToRoute('psycho_index');
    }


}
