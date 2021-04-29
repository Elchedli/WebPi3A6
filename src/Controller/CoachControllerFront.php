<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Form\CoachType;
use App\Repository\CoachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coachfront")
 */
class CoachControllerFront extends AbstractController
{
    /**
     * @Route("/", name="coachfront_index", methods={"GET"})
     */
    public function index(CoachRepository $CoachRepository): Response
    {
        return $this->render('coachfront/index.html.twig', [
            'coachs' => $CoachRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="coachfront_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coach);
            $entityManager->flush();

            return $this->redirectToRoute('coachfront_index');
        }

        return $this->render('coachfront/new.html.twig', [
            'coach' => $coach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coachfront_show", methods={"GET"})
     */
    public function show(Coach $coach): Response
    {
        return $this->render('coachfront/show.html.twig', [
            'coach' => $coach,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="coachfront_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Coach $coach): Response
    {
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coachfront_index');
        }

        return $this->render('coachfront/edit.html.twig', [
            'coach' => $coach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coachfront_delete", methods={"POST"})
     */
    public function delete(Request $request, Coach $coach): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coach->getIduser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coach);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coachfront_index');
    }

    /**
     * @Route("/mm", name="mm", methods={"GET","POST"})
     */
    public function mm(): Response
    {
        return $this->render('../templates/frontend/acceuil.html.twig', [
        ]);
    }

}
