<?php

namespace App\Controller;

use App\Entity\Suivi;
use App\Entity\Tache;
use App\Form\TacheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TacheRepository;
use App\Repository\SuiviRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @Route("/tache")
 */
class TacheController extends AbstractController
{
    /**
     * TacheController constructor.
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->session->set('user','shidono');
        $this->session->set('type','simple');
    }

    /**
     * @Route("/Taches", name="suivi_taches", methods={"GET"})
     */
    public function listeTachesFront(){
        $em=$this->getDoctrine()->getManager();
        $data = $em->getRepository( Suivi::class)->SuiviTaches($this->session->get('user'));
        return $this->render('frontend/suivi.html.twig',[
            'suivis' => $data,
        ]);
    }

    /**
     * @Route("/todo/{idsuivi}", name="tache_task", methods={"GET"})
     */
    public function ToDo($idsuivi){
        $em=$this->getDoctrine()->getManager();
        $data = $em->getRepository( Tache::class)->TachesToDo($this->session->get('user'),$idsuivi);
        return $this->render('frontend/todo.html.twig',[
            'taches' => $data,
        ]);
    }

    /**
     * @Route("/", name="tache_clients", methods={"GET"})
     */
    public function ClientSelect(): Response
    {
        $em=$this->getDoctrine()->getManager();
        $data = $em->getRepository( Suivi::class)->SuiviClients();
        return $this->render('tache/client.html.twig', [
            'clients' => $data,
        ]);
    }




    /**
     * @Route("/liste/{NomClient}", name="suivi_liste", methods={"GET"})
     */
    public function listeSuivi($NomClient){
        $em=$this->getDoctrine()->getManager();
        $data = $em->getRepository( Suivi::class)->SuiviSelect($NomClient);
        return $this->render('tache/client.html.twig',[
            'suivis' => $data,
        ]);
    }

    /**
     * @Route("/index/{idS}", name="tache_index", methods={"GET"})
     */
    public function index($idS): Response{
        $em=$this->getDoctrine()->getManager();
        $data = $em->getRepository( Tache::class)->chercherTaches($idS);
        return $this->render('tache/index.html.twig',[
            'taches' => $data,
            'idS' => $idS
        ]);
    }
    /**
     * @Route("/new/{idS}", name="tache_new", methods={"GET","POST"})
     */
    public function new(Request $request,$idS){
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tache);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('notif', 'fait');
            return $this->redirectToRoute('tache_index',array(
                'idS' => $idS
            ));
        }

        return $this->render('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
            'idS' => $idS
        ]);
    }

    /**
     * @Route("/{idTache}/edit/{idS}", name="tache_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tache $tache,$idS): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tache_index', [
                'idS' => $idS
            ]);
        }
        return $this->render('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
            'idS' => $idS
        ]);
    }

    /**
     * @Route("/effacer/{idTache}/{idS}", name="tache_delete", methods={"GET"})
     */
    public function effacer(Request $request){
        $em = $this->getDoctrine()->getManager();
        $idTache = $request->get('idTache');
        $idS = $request->get('idS');
        $Tache=$em->getRepository(Tache::class)->find($idTache);
        $em->remove($Tache);
        $em->flush();
        $session = $request->getSession();
        $session->set('notif', 'echec');
        return $this->redirectToRoute('tache_index', [
            'idS' => $idS
        ]);
    }
}
