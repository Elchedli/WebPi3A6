<?php

namespace App\Controller;

use App\Entity\Suivi;
use App\Entity\Tache;
use App\Form\TacheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tache")
 */
class TacheController extends AbstractController
{
    /**
     * @Route("/", name="tache_index", methods={"GET"})
     */
    public function index(): Response
    {
        $taches = $this->getDoctrine()
            ->getRepository(Tache::class)
            ->findAll();
        return $this->render('tache/index.html.twig', [
            'taches' => $taches,
        ]);
    }

    /**
     * @Route("/new", name="tache_new", methods={"GET","POST"})
     */
    public function new(Request $request){
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tache);
            $entityManager->flush();
            return $this->redirectToRoute('tache_index');
        }

        return $this->render('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTache}/edit", name="tache_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tache $tache): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tache_index');
        }

        return $this->render('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/effacer/{idTache}", name="tache_delete", methods={"GET","POST"})
     */
    public function effacer($idTache){
        $em = $this->getDoctrine()->getManager();
        $suivi=$em->getRepository(Suivi::class)->find($idTache);
        $em->remove($suivi);
        $em->flush();
        return $this->redirectToRoute('tache_index');
    }
}
