<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Suivi;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/reclamation")
*/
class ReclamationController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        //$this->username = $this->session->get('user');
        //$this->id_user = $this->session->get('id_user');
    }

    /**
     * @Route("/", name="reclamation_index", methods={"GET"})
     * @param ReclamationRepository $reclamationRepository
     * @return Response
     */
    public function index(ReclamationRepository $reclamationRepository, Request $request ,paginatorInterface $paginator): Response
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation = $em->getRepository( Suivi::class)->afficherreclamations();
        $reclamation = $paginator->paginate(
            $reclamation,
            $request->query->getInt('page', 1),
            3);
        return $this->render('Front/reclamation/index.html.twig', [
            'reclamations' => $reclamation,
        ]);
    }

    /**
     * @Route("/add", name="reclamation_new", methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        $reclamation = new Reclamation();
        $reclamation->setDateRec(New DateTime());
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setUsername($this->session->get('user'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'Ajoutée avec succès'
            );

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('Front/reclamation/add.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRec}", name="reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('Front/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{idRec}/edit", name="reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'info',
                'Modifiée avec succès'
            );

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('Front/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRec}", name="reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdRec(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Supprimée avec succès'
            );
        }

        return $this->redirectToRoute('reclamation_index');

    }


}