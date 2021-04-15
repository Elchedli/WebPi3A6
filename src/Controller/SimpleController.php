<?php

namespace App\Controller;

use App\Entity\Simple;
use App\Form\SimpleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/simple")
 */
class SimpleController extends AbstractController
{
    /**
     * @Route("/", name="simple_index", methods={"GET"})
     */
    public function index(): Response
    {
        $simples = $this->getDoctrine()
            ->getRepository(Simple::class)
            ->findAll();

        return $this->render('simple/index.html.twig', [
            'simples' => $simples,
        ]);
    }

    /**
     * @Route("/new", name="simple_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $simple = new Simple();
        $form = $this->createForm(SimpleType::class, $simple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($simple);
            $entityManager->flush();

            return $this->redirectToRoute('simple_index');
        }

        return $this->render('simple/new.html.twig', [
            'simple' => $simple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}", name="simple_show", methods={"GET"})
     */
    public function show(Simple $simple): Response
    {
        return $this->render('simple/show.html.twig', [
            'simple' => $simple,
        ]);
    }

    /**
     * @Route("/{idUser}/edit", name="simple_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Simple $simple): Response
    {
        $form = $this->createForm(SimpleType::class, $simple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('simple_index');
        }

        return $this->render('simple/edit.html.twig', [
            'simple' => $simple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}", name="simple_delete", methods={"POST"})
     */
    public function delete(Request $request, Simple $simple): Response
    {
        if ($this->isCsrfTokenValid('delete'.$simple->getIdUser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($simple);
            $entityManager->flush();
        }

        return $this->redirectToRoute('simple_index');
    }
}
