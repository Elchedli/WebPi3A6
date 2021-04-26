<?php

namespace App\Controller;

use App\Entity\Simple;
use App\Form\SimpleType;
use App\Repository\SimpleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/simple")
 */
class SimpleController extends AbstractController
{
    /**
     * @Route("/", name="simple_index", methods={"GET"})
     */
    public function index(SimpleRepository $simpleRepository): Response
    {
        return $this->render('simple/index.html.twig', [
            'simples' => $simpleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="simple_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $simple = new Simple();
        $form = $this->createForm(SimpleType::class, $simple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($simple);
            $entityManager->flush();

            return $this->redirectToRoute('simple_index');
        }

        return $this->render('simple/new.html.twig', [
            'simple' => $simple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_user}", name="simple_show", methods={"GET"})
     */
    public function show(Simple $simple): Response
    {
        return $this->render('simple/show.html.twig', [
            'simple' => $simple,
        ]);
    }

    /**
     * @Route("/{id_user}/edit", name="simple_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Simple $simple): Response
    {
        $form = $this->createForm(SimpleType::class, $simple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('simple_index');
        }

        return $this->render('simple/edit.html.twig', [
            'simple' => $simple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_user}", name="simple_delete", methods={"POST"})
     */
    public function delete(Request $request, Simple $simple): Response
    {
        if ($this->isCsrfTokenValid('delete'.$simple->getIduser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($simple);
            $entityManager->flush();
        }

        return $this->redirectToRoute('simple_index');
    }

    /**
     * @Route("/recherche", name="rechercheSimple")
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {

        $data = $request->request->get('search');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT s FROM App\Entity\Simple s
    WHERE s.username    LIKE :data')
            ->setParameter('data', '%'.$data.'%');


        $simple = $query->getResult();

        return $this->render('simple/index.html.twig', array(
            'simples' => $simple));

    }

    /**
     * @Route("/recherche", name="recherche", methods={"POST", "GET"})
     */
    public function recherche(Request $request):response
    {
        $id = $request->request->get('request');
        if ($id!="")
        {

            $query =$this->getDoctrine()->getRepository(Simple::class)->createQueryBuilder('u');
            $query->where('u.username LIKE :username')
                ->setParameter("username","%$id%")
                ->getQuery();


            $simple = $query->getQuery()->getResult();

        }
        else
        {
            $simple = $this->getDoctrine()
                ->getRepository(Simple::class)
                ->findAll();
        }


        return $this->json(['blog' => $blog]);
    }

    //Fonction tri (Metier 1)
    /**
     * @Route("triH", name="tri")
     */
    public function tri(Request $request, SimpleRepository $repository):Response
    {
        //Retrieve the entity manager of Doctrine
        $order= $request->get('type');
        if ($order == 'Croissant')
        {
            $Simple = $repository->tri_asc();
        }
        else
        {
            $Simple = $repository->tri_desc();
        }
        //Render the twig view
        return $this->render('simple/show.html.twig', ['Simple' =>$Simple]);
    }
}
