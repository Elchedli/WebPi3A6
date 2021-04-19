<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Suivi;
use App\Form\SuiviType;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/suivi",methods={"GET","POST"})
 */
class SuiviController extends AbstractController
{
    /**
     * @Route("/", name="suivi_main", methods={"GET"})
     */
    public function index(): Response
    {
        $suivis = $this->getDoctrine()
            ->getRepository(Suivi::class)
            ->findAll();

        return $this->render('backend/suivi.html.twig', [
            'suivis' => $suivis,
        ]);
    }
    /**
     * @Route("/index/{id}", name="suivi_index", methods={"GET","POST"})
     * @param $id
     * @return Response
     */
    public function indexjson($id): Response {
        $suivis = $this->getDoctrine()
            ->getRepository(Suivi::class)
            ->findAll();
        if($id == 1) return $this->json(['code' => 200,'message'=>$suivis],200);
        else return $this->render('suivi/index.html.twig', [
            'suivis' => $suivis,
        ]);
    }

    /**
     * @Route("/new", name="suivi_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $suivi = new Suivi();
        $form = $this->createForm(SuiviType::class, $suivi);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($suivi);
//            try{
                $entityManager->flush();
//            }catch (PDOException $e) {
//                return $this->json("no");
//            }
            return $this->json("work");
        }
        return $this->render('suivi/new.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idS}", name="suivi_show", methods={"GET","POST"})
     * @param Suivi $suivi
     * @return Response
     */
    public function show(Suivi $suivi): Response
    {
        return $this->render('suivi/show.html.twig', [
            'suivi' => $suivi,
        ]);
    }

    /**
     * @Route("/{idS}/edit", name="suivi_edit", methods={"GET","POST"})
     */
    public function edit($idS,Request $request,ValidatorInterface $validator){
        $form = $this->createForm(SuiviType::class);
        $form= $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        $suivi=$em->getRepository(Suivi::class)->find($idS);
        if ($form->isSubmitted()) {
            dump($request);
            $suivi->setUsername($request->request->get('suivi')['username']);
            $suivi->setClient($request->request->get('suivi')['client']);
            $suivi->setDateDs($request->request->get('suivi')['DateDs']);
            $suivi->setDateFs($request->request->get('suivi')['DateFs']);
            $suivi->setTempsDs($request->request->get('suivi')['TempsDs']);
            $suivi->setTempsFs($request->request->get('suivi')['TempsFs']);
            $errors = $validator->validate($suivi);
            dump($errors);
            if (count($errors) > 0) {
                return $this->render('suivi/edit.html.twig', [
                    'form' => $form->createView(),
                    'suivi' => $suivi,
                    'errors' => $errors
                ]);
            }
            $em->flush();
            return $this->redirectToRoute('suivi_main');
        }

        return $this->render('suivi/edit.html.twig',[
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
//        if ($form->isSubmitted() && $form->isValid()) {
//            try{
//                $this->getDoctrine()->getManager()->flush();
////                return $this->redirectToRoute('suivi_index');
//                return new JsonResponse("work");
//            }catch (PDOException $e) {
//                return new JsonResponse("foreign");
//            }
//        }
////        return new JsonResponse("no");
//        return $this->render('suivi/edit.html.twig',[
//            'suivi' => $suivi,
//            'form' => $form->createView(),
//        ]);
    }

    /**
     * @Route("/effacer/{idS}", name="suivi_delete", methods={"GET","POST"})
     * @return Response
     */
    public function effacer($idS): Response
    {
        $em = $this->getDoctrine()->getManager();
        $suivi=$em->getRepository(Suivi::class)->find($idS);
        $em->remove($suivi);
        $em->flush();
        return $this->redirectToRoute('suivi_main');
    }
}
