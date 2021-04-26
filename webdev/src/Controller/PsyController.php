<?php

namespace App\Controller;

use App\Entity\Psy;
use App\Form\PsyType;
use App\Repository\PaginationService;
use App\Repository\PsyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/psy")
 */
class PsyController extends AbstractController
{
    // const ITEMS_PER_PAGE = 3;

    /**
     * @Route("/", name="psy_index", methods={"GET"})
     */
    public function index(PaginationService $paginationService, PsyRepository $psyRepository): Response
    {
        return $this->render('psy/index.html.twig', [
            'psies' => $psyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="psy_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $psy = new Psy();
        $form = $this->createForm(PsyType::class, $psy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($psy);
            $entityManager->flush();

            return $this->redirectToRoute('psy_index');
        }

        return $this->render('psy/new.html.twig', [
            'psy' => $psy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param PsyRepository $PsyRepository
     * @return Response
     * @Route ("psy/index", name="index")
     */
    public function Affiche(PaginationService $pagination, Request $request)
    {
        $query = $this->getDoctrine()->getRepository(Psy::class)->createQueryBuilder('u');
        $results = $pagination->paginate($query, $request, self::ITEMS_PER_PAGE);
        return $this->render(
            'psy/index.html.twig',[
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

            $query =$this->getDoctrine()->getRepository(Psy::class)->createQueryBuilder('p');
            $query->where('p.username LIKE :username')
                ->setParameter("username","%$id%")
                ->getQuery();


            $blog = $query->getQuery()->getResult();

        }
        else
        {
            $blog = $this->getDoctrine()
                ->getRepository(Psy::class)
                ->findAll();
        }


        return $this->json(['blog' => $blog]);
    }

    /**
     * @Route("/{id}", name="psy_show", methods={"GET"})
     */
    public function show(Psy $psy): Response
    {
        return $this->render('psy/show.html.twig', [
            'psy' => $psy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="psy_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Psy $psy): Response
    {
        $form = $this->createForm(PsyType::class, $psy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('psy_index');
        }

        return $this->render('psy/edit.html.twig', [
            'psy' => $psy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="psy_delete", methods={"POST"})
     */
    public function delete(Request $request, Psy $psy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$psy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($psy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('psy_index');
    }
}
