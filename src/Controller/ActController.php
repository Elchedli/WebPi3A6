<?php

namespace App\Controller;

use App\Entity\Act;
use App\Form\Act1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/act")
 */
class ActController extends AbstractController
{
    /**
     * @Route("/", name="act_index", methods={"GET"})
     */
    public function index(): Response
    {
        $acts = $this->getDoctrine()
            ->getRepository(Act::class)
            ->findAll();

        return $this->render('act/index.html.twig', [
            'acts' => $acts,
        ]);
    }

    /**
     * @Route("/new", name="act_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $act = new Act();
        $form = $this->createForm(Act1Type::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $fileName = $safeFilename.'.'.$image->guessExtension();
                try{
                    $image->move(
                        $this->getParameter('upload_directory'),$fileName);
                } catch (FileException $e)
                {
                }
                $act->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($act);
            $entityManager->flush();

            return $this->redirectToRoute('act_index');
        }

        return $this->render('act/new.html.twig', [
            'act' => $act,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAct}", name="act_show", methods={"GET"})
     */
    public function show(Act $act): Response
    {
        return $this->render('act/show.html.twig', [
            'act' => $act,
        ]);
    }

    /**
     * @Route("/{idAct}/edit", name="act_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Act $act): Response
    {
        $form = $this->createForm(Act1Type::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();


            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $fileName = $safeFilename.'.'.$image->guessExtension();
                try{
                    $image->move(
                        $this->getParameter('upload_directory'),$fileName);
                } catch (FileException $e)
                {
                }
                $act->setImage($fileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('act_index');
        }

        return $this->render('act/edit.html.twig', [
            'act' => $act,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAct}", name="act_delete", methods={"POST"})
     */
    public function delete(Request $request, Act $act): Response
    {
        if ($this->isCsrfTokenValid('delete'.$act->getIdAct(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($act);
            $entityManager->flush();
        }

        return $this->redirectToRoute('act_index');
    }
}
