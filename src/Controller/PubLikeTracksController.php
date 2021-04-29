<?php

namespace App\Controller;

use App\Entity\PubLikeTracks;
use App\Form\PubLikeTracksType;
use App\Repository\PubLikeTracksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pub/like/tracks")
 */
class PubLikeTracksController extends AbstractController
{
    /**
     * @Route("/", name="pub_like_tracks_index", methods={"GET"})
     */
    public function index(PubLikeTracksRepository $pubLikeTracksRepository): Response
    {
        return $this->render('pub_like_tracks/index.html.twig', [
            'pub_like_tracks' => $pubLikeTracksRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pub_like_tracks_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pubLikeTrack = new PubLikeTracks();
        $form = $this->createForm(PubLikeTracksType::class, $pubLikeTrack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pubLikeTrack);
            $entityManager->flush();

            return $this->redirectToRoute('pub_like_tracks_index');
        }

        return $this->render('pub_like_tracks/new.html.twig', [
            'pub_like_track' => $pubLikeTrack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pub_like_tracks_show", methods={"GET"})
     */
    public function show(PubLikeTracks $pubLikeTrack): Response
    {
        return $this->render('pub_like_tracks/show.html.twig', [
            'pub_like_track' => $pubLikeTrack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pub_like_tracks_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PubLikeTracks $pubLikeTrack): Response
    {
        $form = $this->createForm(PubLikeTracksType::class, $pubLikeTrack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pub_like_tracks_index');
        }

        return $this->render('pub_like_tracks/edit.html.twig', [
            'pub_like_track' => $pubLikeTrack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pub_like_tracks_delete", methods={"POST"})
     */
    public function delete(Request $request, PubLikeTracks $pubLikeTrack): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pubLikeTrack->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pubLikeTrack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pub_like_tracks_index');
    }



    public function add($id_user,$id_pub):Response
    {
        $pubLikeTrack = new PubLikeTracks();
        $pubLikeTrack->setIdUser($id_user);
        $pubLikeTrack->setIdPub($id_pub);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pubLikeTrack);
        $entityManager->flush();
      return new  Response('Inserted , ID = '.$pubLikeTrack->getId());
    }

}
