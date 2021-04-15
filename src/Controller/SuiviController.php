<?php

namespace App\Controller;

use App\Entity\Suivi;
use App\Form\SuiviType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/suivi")
 */
class SuiviController extends AbstractController
{
    /**
     * @Route("/", name="suivi_index", methods={"GET"})
     */
    public function index(): Response
    {
        $suivis = $this->getDoctrine()
            ->getRepository(Suivi::class)
            ->findAll();

        return $this->render('suivi/index.html.twig', [
            'suivis' => $suivis,
        ]);
    }

    /**
     * @Route("/new", name="suivi_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $suivi = new Suivi();
        $form = $this->createForm(SuiviType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($suivi);
            $entityManager->flush();

            return $this->redirectToRoute('suivi_index');
        }

        return $this->render('suivi/new.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idS}", name="suivi_show", methods={"GET","POST"})
     * @param Suivi $suivi
     * @return Response
     */
    public function show(Suivi $suivi): Response
    {
        return $this->render('suivi/show.html.twig', [
            'suivi' => $suivi,
        ]);
    }

    /**
     * @Route("/{idS}/edit", name="suivi_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Suivi $suivi
     * @return Response
     */
    public function edit(Request $request, Suivi $suivi): Response
    {
        $form = $this->createForm(SuiviType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('suivi_index');
        }

        return $this->render('suivi/edit.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/effacer/{idS}", name="suivi_delete", methods={"GET","POST"})
     * @return Response
     */
    public function effacer($idS): Response
    {
        $em = $this->getDoctrine()->getManager();
        $suivi=$em->getRepository(Suivi::class)->find($idS);
        $em->remove($suivi);
        $em->flush();
        return $this->redirectToRoute('suivi_index');
    }
}
