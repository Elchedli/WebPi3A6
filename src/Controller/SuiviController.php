<?php

namespace App\Controller;

use App\Command\SuiviparcsvCommand;
use App\Entity\Suivi;
use App\Form\SuiviType;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/suivi")
 */
class SuiviController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="suivi_index", methods={"GET"})
     */
    public function index(): Response
    {
        $suivis = $this->getDoctrine()->getRepository(Suivi::class)->afficher();
        return $this->render('suivi/index.html.twig', [
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
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($suivi);
            $entityManager->flush();
            $this->session->set('notif', 'fait');
            return $this->redirectToRoute('suivi_index');
        }
        return $this->render('suivi/new.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/indexjson", name="index_json", methods={"GET"})
     */
    public function indexjson(Request $request): Response{
        $json = $request->getContent();
        $json = json_decode($json);
        $suivis = $this->getDoctrine()->getRepository(Suivi::class)->afficher2($json->username);
        return new JsonResponse($suivis);
    }
    /**
     * @Route("/newjson", name="newjson",methods={"GET","POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function newjson(Request $request,SerializerInterface $serializer) : Response{
        //$json = $request->getContent();
        //$suivi = $serializer->deserialize($json,Suivi::class,'json');
        $suivi = new Suivi();
        $suivi->setUsername($request->get("username"));
        $suivi->setClient($request->get("client"));
        $suivi->setTitreS($request->get("titre"));
        $suivi->setDateDs($request->get("dateds"));
        $suivi->setDateFs($request->get("datefs"));
        $suivi->setTempsDs($request->get("tempsds"));
        $suivi->setTempsDs($request->get("tempsfs"));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($suivi);
        $entityManager->flush();
        return new JsonResponse(true);
    }

    /**
     * @Route("/editjson", name="edit_suivijson", methods={"GET","POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function editjson(Request $request,SerializerInterface $serializer) : Response{
        $json = $request->getContent();
        $suivijson = $serializer->deserialize($json,Suivi::class,'json');
        $suivi = $this->getDoctrine()->getRepository(Suivi::class)->changer($suivijson);
        $suivbase=$this->getDoctrine()->getRepository(Suivi::class)->find($suivijson->getIdS());
        echo $suivi;
        if($suivi) return new JsonResponse($suivbase->getUsername());
        return new JsonResponse("rien");
    }

    /**
     * @Route("/supprimerjson", name="supp_suivijson", methods={"GET","POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function deletejson(Request $request,SerializerInterface $serializer) : Response{
        $json = $request->getContent();
        $suivi = $serializer->deserialize($json,Suivi::class,'json');
        $em = $this->getDoctrine()->getManager();
        $suivbase=$em->getRepository(Suivi::class)->find($suivi->getIdS());
        if($suivbase){
            $em->remove($suivbase);
            $em->flush();
            return new JsonResponse(true);
        }
        return new JsonResponse(false);
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
     * @param Request $request
     * @param Suivi $suivi
     * @return Response
     */
    public function edit(Request $request, Suivi $suivi): Response
    {
        $form = $this->createForm(SuiviType::class, $suivi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('suivi_index');
        }

        return $this->render('suivi/edit.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/effacer/{idS}", name="suivi_delete", methods={"GET","POST"})
     */
    public function effacer(Request $request,$idS) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $suivi=$em->getRepository(Suivi::class)->find($idS);
        $em->remove($suivi);
        $em->flush();
        $this->session->set('notif', 'echec');
        return $this->redirectToRoute('suivi_index');
    }



    /**
     * @Route("/convers", name="convert")
     * @throws \Exception
     */
    public function convert(KernelInterface $kernel) : Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'app:creation-suivi',
        ]);
        $output = new BufferedOutput();
        $application->run($input, $output);
        $content = $output->fetch();
        return new JsonResponse("cool");
    }


}
