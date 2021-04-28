<?php

namespace App\Controller;

use App\Entity\Psycho;
use App\Form\PsychoType;
use App\Repository\PaginationService;
use App\Repository\PsychoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Psycho")
 */
class PsychoController extends AbstractController
{
    // const ITEMS_PER_PAGE = 3;

    /**
     * @Route("/", name="Psycho_index", methods={"GET"})
     */
    public function index(PaginationService $paginationService, PsychoRepository $PsychoRepository): Response
    {
        return $this->render('psy/index.html.twig', [
            'psies' => $PsychoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Psycho_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Psycho = new Psycho();
        $form = $this->createForm(PsychoType::class, $Psycho);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Psycho);
            $entityManager->flush();
            return $this->redirectToRoute('Psy_index');
        }

        return $this->render('psy/new.html.twig', [
            'Psy' => $Psycho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param PsychoRepository $PsychoRepository
     * @return Response
     * @Route ("Psycho/index", name="index")
     */
    public function Affiche(PaginationService $pagination, Request $request)
    {
        $query = $this->getDoctrine()->getRepository(Psycho::class)->createQueryBuilder('u');
        $results = $pagination->paginate($query, $request, self::ITEMS_PER_PAGE);
        return $this->render(
            'Psycho/index.html.twig',[
                'Psy' =>$results,
                'lastPage' =>$pagination->lastPage($results)
            ]);
    }

    /**
     * @Route("/recherche", name="recherche", methods={"POST", "GET"})
     */
    public function recherche(Request $request):response
    {
        $id = $request->request->get('request');
        if ($id!="")
        {

            $query =$this->getDoctrine()->getRepository(Psycho::class)->createQueryBuilder('p');
            $query->where('p.username LIKE :username')
                ->setParameter("username","%$id%")
                ->getQuery();
            $blog = $query->getQuery()->getResult();

        }
        else
        {
            $blog = $this->getDoctrine()
                ->getRepository(Psycho::class)
                ->findAll();
        }
        return $this->json(['blog' => $blog]);
    }

    /**
     * @Route("/{id}", name="Psycho_show", methods={"GET"})
     */
    public function show(Psycho $Psycho): Response
    {
        return $this->render('Psy/show.html.twig', [
            'Psycho' => $Psycho,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Psycho_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Psycho $Psycho): Response
    {
        $form = $this->createForm(PsychoType::class, $Psycho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Psycho_index');
        }

        return $this->render('psy/edit.html.twig', [
            'Psycho' => $Psycho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Psycho_delete", methods={"POST"})
     */
    public function delete(Request $request, Psycho $Psycho): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Psycho->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Psycho);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Psycho_index');
    }
}
