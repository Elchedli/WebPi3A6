<?php

namespace App\Controller;

use App\Entity\PhotoPublication;
use App\Form\PhotoPublicationType;
use App\Repository\PhotoPublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/photo/publication")
 */
class PhotoPublicationController extends AbstractController
{
    /**
     * @Route("/", name="photo_publication_index", methods={"GET"})
     */
    public function index(PhotoPublicationRepository $photoPublicationRepository): Response
    {
        return $this->render('photo_publication/index.html.twig', [
            'photo_publications' => $photoPublicationRepository->findAll(),
        ]);
    }
    /**
     * @Route("/show/{id_pub}", name="photos_publication", methods={"GET"})
     */
    public function Targeted_photos(PhotoPublicationRepository $photoPublicationRepository,$id_pub): Response
    {
        return $this->render('photo_publication/index.html.twig', [
            'photo_publications' => $photoPublicationRepository->findBy(['id_pub'=> $id_pub]),
            'id_pub'=>$id_pub
        ]);
    }

    /**
     * @Route("/new", name="photo_publication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $photoPublication = new PhotoPublication();
        $form = $this->createForm(PhotoPublicationType::class, $photoPublication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($photoPublication);
            $entityManager->flush();

            return $this->redirectToRoute('photo_publication_index');
        }

        return $this->render('photo_publication/new.html.twig', [
            'photo_publication' => $photoPublication,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/new/{id_pub}", name="photo_publication_add", methods={"GET","POST"})
     */
    public function addPhoto(Request $request,$id_pub): Response
    {
        $photoPublication = new PhotoPublication();
        $form = $this->createForm(PhotoPublicationType::class, $photoPublication);
        $photoPublication->setIdPub($id_pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($photoPublication);
            $entityManager->flush();

            return $this->redirectToRoute('publication');
        }

        return $this->render('photo_publication/new.html.twig', [
            'photo_publication' => $photoPublication,
            'form' => $form->createView(),
            'id_pub'=>$id_pub
        ]);
    }

    /**
     * @Route("/{id_ph}", name="photo_publication_show", methods={"GET"})
     */
    public function show(PhotoPublication $photoPublication): Response
    {
        return $this->render('photo_publication/show.html.twig', [
            'photo_publication' => $photoPublication,
        ]);
    }

    /**
     * @Route("/{id_ph}/edit", name="photo_publication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PhotoPublication $photoPublication): Response
    {
        $form = $this->createForm(PhotoPublicationType::class, $photoPublication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publication');
        }

        return $this->render('photo_publication/edit.html.twig', [
            'photo_publication' => $photoPublication,
            'form' => $form->createView(),
            'id_pub'=>$photoPublication->getIdPub()
        ]);
    }

    /**
     * @Route("/{id_ph}", name="photo_publication_delete", methods={"POST"})
     */
    public function delete(Request $request, PhotoPublication $photoPublication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photoPublication->getId_ph(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($photoPublication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publication');
    }
}
