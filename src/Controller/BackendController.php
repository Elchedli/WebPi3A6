<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Reclamation;
use App\Form\CategoriesType;
use App\Form\ReclamationType;
use App\Repository\CategoriesRepository;
use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\Collection;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BackendController extends AbstractController
{
    /**
     * @Route("/backend", name="backend")
     */

    /**
     * @Route("/backend/cat", name="categories_indexx", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('Back/categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/backend/cat/add", name="categories_neww", methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        $categories= new Categories();
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories);
            $em->flush();

            $this->addFlash(
                'info',
                'Added successfully'
            );
            return $this->redirectToRoute('categories_indexx');
        }

        return $this->render('Back/categories/add.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("//backend/cat/{idCat}", name="categories_showw", methods={"GET"})
     */
    public function show(Categories $categories): Response
    {
        return $this->render('Back/categories/show.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/backend/cat/{idCat}/edit", name="categories_editt", methods={"GET","POST"})
     */
    public function edit(Request $request, Categories $categories): Response
    {
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_indexx');
        }

        return $this->render('Back/categories/edit.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/backend/cat/{idCat}", name="categories_deletee", methods={"POST"})
     */
    public function delete(Request $request, Categories $categories): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categories->getIdCat(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categories);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_indexx');
    }

    /**
     * @Route("/backend/rec", name="reclamation_indexx", methods={"GET"})
     */
    public function indexRec(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('Back/reclamation/index.html.twig', [
            'reclamation' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/backend/rec/{idRec}", name="reclamation_showw", methods={"GET"})
     */
    public function showRec(Reclamation $reclamation): Response
    {
        return $this->render('Back/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/backend/rec/{idRec}/edit", name="reclamation_editt", methods={"GET","POST"})
     */
    public function editRec(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_indexx');
        }

        return $this->render('Back/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/backend/rec/{idRec}", name="reclamation_deletee", methods={"POST"})
     */
    public function deleteRec(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdRec(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Deleted successfully'
            );
        }

        return $this->redirectToRoute('reclamation_indexx');

    }

    /**
     * @Route("/pdf/salma", name="imprimer", methods={"GET"})
     */
    public function pdf(ReclamationRepository $reclamationRepository): Response
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('Back/reclamation/pdf.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();


        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }

    /**
    # * @Route("/backend/rec/archive/{id}", name="recarchive")
     */
    #public function archive(Reclamation $reclamation)
   # {
       # if ($reclamation->getEtatRec() == 'To do') {
           # $reclamation->setEtatRec('Done');
            #$reclamation = $reclamation ->getIdRec();
            #$this->em->persist($reclamation);
            #$this->em->flush();
            #$this->addFlash('success', "Archive effectué avec succès!");
        #}else {
        #    $this->addFlash('success', "Deja archivé !");
        #}
        #return $this->redirectToRoute('reclamation_indexx');
    #}


    /**
     * @param ReclamationRepository $reclamationRepository
     * @return Response
     * @Route("/backend/stat", name="statistique")
     */
    public function statistique(ReclamationRepository $reclamationRepository)
    {
        $reclamation = $reclamationRepository->findAll();
        $catType= ['Done', 'To do']; #, 'Suivi', 'Msg', 'Technical', 'Posts'];
        $catColor = ['#49A9EA', '#36CAAB']; #, '#34495E', '#B370CF', '#AC5353', '#CFD4D8'];
        $catDone= count($reclamationRepository->findBy(["etatRec" =>"Done"]) )  ;
        $catToDo = count($reclamationRepository->findBy(["etatRec" =>"To do"]) ) ;
        #$catSuivi = count($reclamationRepository->findBy(["idCat" => "Suivi"]) ) ;
        #$catMsg= count($reclamationRepository->findBy(["idCat" =>"Msg"]) )  ;
        #$catTechnical = count($reclamationRepository->findBy(["idCat" =>"Technical"]) ) ;
        #$catPosts = count($reclamationRepository->findBy(["idCat" => "Posts"]) ) ;
        $catCount = [ $catDone, $catToDo]; #,$categSuivi, $categMsg, $categTechnical, $categPosts];

        return $this->render('Back/reclamation/stats.html.twig',
            ['catType' => json_encode($catType),
                'catColor' => json_encode($catColor),
                'catCount' => json_encode($catCount),


            ]);
    }

}
