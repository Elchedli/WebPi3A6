<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/", name="commentaire_index", methods={"GET"})
     */
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }
    /**
     * @Route("/p_{id_pub}", name="commentaire_indexx", methods={"GET"})
     */
    public function indexx(CommentaireRepository $commentaireRepository,$id_pub): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findBy(['id_pub'=> $id_pub]),
            'id_pub'=>$id_pub,
        ]);
    }

    /**
     * @Route("/new", name="commentaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_index');
        }

        return $this->render('commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new/{id_pub}_{id_user}", name="commentaire_new_", methods={"GET","POST"})
     */
    public function newComment(Request $request, $id_pub,$id_user): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setIdPub($id_pub);
            $commentaire->setIdUser($id_user);
            $commentaire->setDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_indexx',['id_pub'=>$id_pub]);
        }

        return $this->render('commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newComm/{id_pub}_{id_user}", name="commentaire_new_front", methods={"GET","POST"})
     */
    public function newCommentFront(Request $request, $id_pub,$id_user): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setIdPub($id_pub);
            $commentaire->setIdUser($id_user);
            $commentaire->setDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('publication');
        }

        return $this->render('commentaire/newFront.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/show_commentaire/{id}_{id_pub}", name="commentaire_show", methods={"GET"})
     */
    public function show(Commentaire $commentaire,$id_pub): Response
    {
        dump($commentaire);
        return $this->render('commentaire/show.html.twig', [
            'commentaire' => $commentaire,
            'id_pub'=>$id_pub,
        ]);
    }

    /**
     * @Route("/edit/{id}_{id_pub}", name="commentaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commentaire $commentaire,$id_pub): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_indexx',['id_pub'=>$id_pub]);
        }

        return $this->render('commentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'id_pub'=>$id_pub,
        ]);
    }

    /**
     * @Route("/delete_commentaire/{id}_{id_pub}", name="commentaire_delete", methods={"POST","GET"})
     */
    public function delete(Request $request, Commentaire $commentaire,$id_pub): Response
    {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaire);
            $entityManager->flush();


        return $this->redirectToRoute('commentaire_indexx',['id_pub'=>$id_pub]);
    }
}
