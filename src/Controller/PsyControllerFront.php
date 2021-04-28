<?php

namespace App\Controller;

use App\Entity\Psy;
use App\Form\PsyType;
use App\Repository\PsyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/psyfront")
 */
class PsyControllerFront extends AbstractController
{
    /**
     * @Route("/", name="psyfront_index", methods={"GET"})
     */
    public function index(PsyRepository $psyRepository): Response
    {
        return $this->render('psyfront/index.html.twig', [
            'psys' => $psyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="psyfront_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $psy = new Psy();
        $form = $this->createForm(PsyType::class, $psy);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($psy);  
            $entityManager->flush();

            return $this->redirectToRoute('psyfront_index');
        }

        return $this->render('psyfront/new.html.twig', [
            'psy' => $psy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="psyfront_show", methods={"GET"})
     */
    public function show(Psy $psy): Response
    {
        return $this->render('psyfront/show.html.twig', [
            'psy' => $psy,
        ]);
    }

    /**
     * @Route("/{id_user}/edit", name="psyfront_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Psy $psy): Response
    {
        $form = $this->createForm(PsyType::class, $psy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('psyfront_index');
        }

        return $this->render('psyfront/edit.html.twig', [
            'psy' => $psy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_user}", name="psyfront_delete", methods={"POST"})
     */
    public function delete(Request $request, Psy $psy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$psy->getIduser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($psy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('psyfront_index');
    }
}
