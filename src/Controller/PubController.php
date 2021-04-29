<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationType;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pub")
 */
class PubController extends AbstractController
{
    /**
     * @Route("/", name="pub_index", methods={"GET"})
     */
    public function index(PublicationRepository $publicationRepository): Response
    {
        $pform = new Publication();
        $pub = $this->GetAllPubs();
        $form = $this->createFormBuilder($pform)
            ->add('texte',TextareaType::class)
            ->getForm();
        return $this->render('pub/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
            'pubs'=>$pub,
            'formPub'=>$form->createView()
        ]);
    }

    /**
     * @Route("/new", name="pub_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('pub_index');
        }

        return $this->render('pub/new.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_pub}", name="pub_show", methods={"GET"})
     */
    public function show(Publication $publication): Response
    {
        return $this->render('pub/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    /**
     * @Route("/{id_pub}/edit", name="pub_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publication $publication): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pub_index');
        }

        return $this->render('pub/edit.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_pub}", name="pub_delete", methods={"POST"})
     */
    public function delete(Request $request, Publication $publication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getId_pub(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pub_index');
    }
    public function GetAllPubs() : array
    {
        $repo = $this->getDoctrine()->getRepository(Publication::class);
        return $repo->findAll();
    }
}
