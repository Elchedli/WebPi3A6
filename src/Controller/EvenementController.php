<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginato

/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     */
    public function index(evenementRepository $evenementRepositoryRepository,Request $request ,paginatorInterface $paginator): Response
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();
        $evenements = $paginator->paginate(
            $evenements,
            $request->query->getInt('page', 1),
            4);
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
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
                $evenement->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Added successfully'
            );
            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEv}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }


    /**
     * @Route("/{idEv}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
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
                $evenement->setImage($fileName);
            }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'info',
                'Edit successfully'
            );
            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEv}", name="evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $evenement->getIdEv(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'delete successfully'
            );
        }

        return $this->redirectToRoute('evenement_index');
    }

    /**
     * @Route("/pdf/islem", name="imprimer", methods={"GET"})
     */
    public function pdf(EvenementRepository $evenementRepository): Response
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('evenement/pdf.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();


        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @param EvenementRepository $EvenementRepository
     * @return Response
     * @Route("/admin/stats", name="Statistic")
     */
    public function adminStat(EvenementRepository $EvenementRepository)
    {
        $evenements = $EvenementRepository->findAll();
        $categType= ["sportif" , "loisir" , "educatif"];
        $categColor = ["#a65959" , "#414e4d" , "#5E8486"];
        $categSportif= count($EvenementRepository->findBy(["typeEv" =>"sportif"]) )  ;
        $categLoisir = count($EvenementRepository->findBy(["typeEv" =>"loisir"]) ) ;
        $categEducatif = count($EvenementRepository->findBy(["typeEv" => "educatif"]) ) ;
        $categCount = [ $categSportif , $categLoisir , $categEducatif ];

            return $this->render('evenement/statistic.html.twig',
            ['categType' => json_encode($categType),
                'categColor' => json_encode($categColor),
                'categCount' => json_encode($categCount),


            ]);
    }

}