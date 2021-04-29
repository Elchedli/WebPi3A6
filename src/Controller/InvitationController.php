<?php

namespace App\Controller;
use App\Entity\Invitation;
use App\Form\Invitation1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/invitation")
 */
class InvitationController extends AbstractController
{
    /**
     * @Route("/", name="invitation_index", methods={"GET"})
     */
    public function index(): Response
    {
        $invitations = $this->getDoctrine()
            ->getRepository(Invitation::class)
            ->findAll();

        return $this->render('invitation/index.html.twig', [
            'invitations' => $invitations,
        ]);
    }

    /**
     * @Route("/new", name="invitation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $invitation = new Invitation();
        $form = $this->createForm(Invitation1Type::class, $invitation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($invitation);
            $entityManager->flush();

            return $this->redirectToRoute('invitation_index');
        }

        return $this->render('invitation/new.html.twig', [
            'invitation' => $invitation,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="invitation_show", methods={"GET"})
//     */
//    public function show(Invitation $invitation): Response
//    {
//        return $this->render('invitation/show.html.twig', [
//            'invitation' => $invitation,
//        ]);
//    }

    /**
     * @Route("/{id}/edit", name="invitation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Invitation $invitation): Response
    {
        $form = $this->createForm(Invitation1Type::class, $invitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invitation_index');
        }

        return $this->render('invitation/edit.html.twig', [
            'invitation' => $invitation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invitation_delete", methods={"POST"})
     */
    public function delete(Request $request,Invitation $invitation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invitation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($invitation);
            $entityManager->flush();
        }
        return $this->redirectToRoute('invitation_index');
    }


}
