<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesnewType;
use App\Form\ArticlesType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/frontend")
 */
class ArticlesController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/testlol", name="test_avissqdqsd")
     */
    public function test(): Response{
        return $this->render('test.html.twig');
    }

        /**
     * @Route("/", name="articles_index", methods={"GET"})
     */

    public function index(ArticleRepository $articleRepository,Request $request ,paginatorInterface $paginator): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->findAll();
        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            2);
        return $this->render('Frontend/articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }


    /**
     * @param ArticleRepository $articleRepository
     * @return Response
     * @Route("/stat", name="statistique")
     */
 public function statistique(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        $catType= ['coach', 'Nutritionniste', 'psy']; #, 'Suivi', 'Msg', 'Technical', 'Posts'];
        $catColor = ['#49A9EA', '#36CAAB', '#34495E'];
        $catArts= count($articleRepository->findBy(["auteurArt" =>"coach"]) )  ;
        $catSante = count($articleRepository->findBy(["auteurArt" =>"Nutritionniste"]) ) ;
        $catMeditation = count($articleRepository->findBy(["auteurArt" => "psy"]) ) ;


        $catCount = [ $catArts, $catSante,$catMeditation]; #,$categSuivi, $categMsg, $categTechnical, $categPosts];

        return $this->render('Backend/articles/stats.html.twig',
            ['catType' => json_encode($catType),
                'catColor' => json_encode($catColor),
                'catCount' => json_encode($catCount),


            ]);
    }

    /**
     * @Route("/pdf/yasmine/{idArt}", name="imprimer", methods={"GET"})
     */
    public function pdf(Articles $article): Response
    {

        $pdfOptions = new Options();

        $pdfOptions->set('isRemoteEnabled', TRUE);
        $pdfOptions->set('isHtml5ParserEnabled', TRUE);
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);


        $html = $this->renderView('Frontend/articles/pdf.html.twig', [
            'article' => $article,
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();


        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $article->setDateArt(New \DateTime());
        $form = $this->createForm(ArticlesnewType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('photo')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $article->setPhoto($fileName);

            $file->move($this->getParameter('images_directory'),$fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($article); //l'ajout dans la base
            ////persist joue le role de insert into
            $em->flush();
            $this->addFlash(
                'info',
                'Article Ajoutée! !'
            );



            return $this->redirectToRoute('articles_index');
        }

        return $this->render('Frontend/articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idArt}", name="articles_show", methods={"GET"})
     */
    public function show(Articles $article): Response
    {

        return $this->render('Frontend/articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{idArt}/edit", name="articles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('photo')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $article->setPhoto($fileName);
            $file->move($this->getParameter('images_directory'),$fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($article); //l'ajout dans la base
            ////persist joue le role de insert into
            $em->flush();
            $array[] = $this->session->get('avis');
            $array[$article->getIdArt()] = $article->getRating();
            $this->session->set('avis',$array);
            return $this->redirectToRoute('articles_index');
        }

        return $this->render('Frontend/articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idArt}", name="articles_delete", methods={"POST"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getIdArt(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }


}
