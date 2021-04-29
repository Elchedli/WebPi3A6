<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\PhotoType;
use App\Form\PublicationType;
use App\Services\QrcodeService;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\EntityManagerInterface;
use App\Controller\ObjectManagerAlias;
use phpDocumentor\Reflection\Types\Object_;
use PhpParser\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Publication;
use App\Controller\PhotoController;
use App\Repository\PublicationRepository;
use App\Repository\CommentaireRepository;
use App\Entity\PubLikeTracks;
use App\Controller\PubLikeTracksController;
use App\Form\CommentaireType;
/**
 * @Route("/publications")
 */
class PublicationController extends AbstractController
{
    public $username = "jeff";
    public $id_user = 1;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->username = $this->session->get('user');
        $this->id_user = $this->session->get('id_user');
    }



    /**
     * @Route("/publication", name="publication_index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {


        $pform = new Publication();

        $comment = new Commentaire();

        $form = $this->createFormBuilder($pform)
                     ->add('texte',TextareaType::class)
                     ->add('post', SubmitType::class, ['label' => 'Publier'])
                     ->getForm();
        $dltForm = $this->createFormBuilder($pform)
            ->add('save', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $pform->setDate(new \DateTime());
            $pform->setId_user($this->id_user);
            $pform->setLikes(0);
            $pform->setUsername($this->username);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pform);
            $entityManager->flush();
            return $this->redirectToRoute('publication_index');
        }


        $pub = $this->GetAllPubs();
        $em=$this->getDoctrine()->getManager();
        $test =$em->getRepository( PubLikeTracks::class)->IsLiked(1,1);
        //$this->add(1,1);
        //$this->redirectToRoute('Add_tracker',['id_user'=>1,'id_pub'=>1]);
        //this->removeTracker(1,1);

        foreach($pub as $key=>$value) {
            $data = $em->getRepository( Commentaire::class)->AffichageComment($value->getId());
            if($data){
                $pub[$key]->comment = $data;
            }
        }
        return $this->render('publication/index.html.twig', [
            'controller_name' => 'PublicationController',
            'pubs'=>$pub,
            'formPub'=>$form->createView(),
            'dltPub'=>$dltForm->createView(),
        ]);
    }

    /**
     * @Route("/BackPublication", name="BackPublication")
     * @param Request $request
     * @return Response
     */
    public function indexBack(Request $request): Response
    {
        $cl = new PubLikeTracksController();


        $pform = new Publication();



        $form = $this->createFormBuilder($pform)
            ->add('texte',TextareaType::class)
            ->add('post', SubmitType::class, ['label' => 'Publier'])
            ->getForm();
        $dltForm = $this->createFormBuilder($pform)
            ->add('save', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $pform->setDate(new \DateTime());
            $pform->setId_user($this->id_user);
            $pform->setLikes(0);
            $pform->setUsername($this->username);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pform);
            $entityManager->flush();
            return $this->redirectToRoute('BackPublication');
        }

        $pub = $this->GetAllPubs();
        return $this->render('publication/acceuil.html.twig', [
            'controller_name' => 'PublicationController',
            'pubs'=>$pub,
            'formPub'=>$form->createView(),
            'dltPub'=>$dltForm->createView()

        ]);
    }

    /**
     * @Route("/pub_{id_pub}", name="pub_view")
     * @param $id_pub
     * @param QrcodeService $qrcodeService
     * @param Request $request
     * @return Response
     */
    public function SeePub($id_pub, QrcodeService $qrcodeService,Request $request)
    {

        $qr = $qrcodeService->qrcode('http://127.0.0.1:8000/pub_'.$id_pub);

        $pub = $this->getDoctrine()->getManager()->getRepository(Publication::class)->find($id_pub);
        return $this->render('publication/viewPub.html.twig', [
            'controller_name' => 'PublicationController',
            'publication'=>$pub,
            "qr"=>$qr,
        ]);

    }




    public function GetAllPubs() : array
    {
    $repo = $this->getDoctrine()->getRepository(Publication::class);
        return $repo->findAll();
}

    /**
     * @Route("/publication/{id}", name="publication_Del")
     */
    public function del($id)
    {
        $man = $this->getDoctrine()->getManager();
        $pub= new Publication();
        $pub->setId($id);
        $pub = $man->
        $man->remove($pub);
        $man->flush();

        return $this->redirectToRoute('publication_index');
    }

    /**
     * @Route("/{id}", name="pub_delete" , methods={"GET","POST"})
     */
    public function delete(Request $request, Publication $publication): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publication);
            $entityManager->flush();

        return $this->redirectToRoute('publication_index');

    }
    /**
     * @Route("/Back/{id}", name="BackPub_delete" , methods={"GET","POST"})
     */
    public function deleteBack(Request $request, Publication $publication): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($publication);
        $entityManager->flush();

        return $this->redirectToRoute('BackPublication');

    }



    /**
     * @Route("/{id_pub}/edit", name="publication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publication $publication): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publication_index');
        }

        return $this->render('pub/edit.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id_pub}/edit", name="BackPublication_edit", methods={"GET","POST"})
     */
    public function editBack(Request $request, Publication $publication): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('BackPublication');
        }

        return $this->render('pub/edit.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }
            //$test2 = $em->getRepository(Publication::class)->Like(274);
    /**
     * @Route("/LikeComm/{id_pub}_{id_user}", name="Pub_like" , methods={"GET","POST"})
     */
    public function LC(Request $request,$id_pub,$id_user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $liked = $entityManager->getRepository(PubLikeTracks::class)->isLiked($id_pub,$id_user);
        if(!$liked)
        {
            $this->addTracker($id_user,$id_pub);
            $repo = $entityManager->getRepository(Publication::class)->Like($id_pub);
        }
        else
        {
            $this->removeTracker($id_user,$id_pub);
            $repo = $entityManager->getRepository(Publication::class)->Dislike($id_pub);
        }
        return $this->redirectToRoute('publication_index');
    }

    /**
     * @Route("/LikeCommBack/{id_pub}_{id_user}", name="Pub_likeBack" , methods={"GET","POST"})
     */
    public function LCB(Request $request,$id_pub,$id_user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $liked = $entityManager->getRepository(PubLikeTracks::class)->isLiked($id_pub,$id_user);
        if(!$liked)
        {
            $this->addTracker($id_user,$id_pub);
            $repo = $entityManager->getRepository(Publication::class)->Like($id_pub);
        }
        else
        {
            $this->removeTracker($id_user,$id_pub);
            $repo = $entityManager->getRepository(Publication::class)->Dislike($id_pub);
        }
        return $this->redirectToRoute('BackPublication');
    }
    public function addTracker($id_user,$id_pub):Response
    {
        $pubLikeTrack = new PubLikeTracks();
        $pubLikeTrack->setIdUser($id_user);
        $pubLikeTrack->setIdPub($id_pub);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pubLikeTrack);
        $entityManager->flush();
        return new  Response('Inserted , ID = '.$pubLikeTrack->getId());
    }

    public function removeTracker($id_user,$id_pub)
    {
        $tracker = new PubLikeTracks();
        $repo = $this->getDoctrine()->getRepository(PubLikeTracks::class);
        $tracker= $repo->findOneBy(['id_user'=>$id_user,'id_pub'=>$id_pub]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tracker);
            $entityManager->flush();

    }
    public function like_dislike($id_user,$id_pub)
{
    $entityManager = $this->getDoctrine()->getManager();
    $liked = $entityManager->getRepository(PubLikeTracks::class)->isLiked($id_pub,$id_user);
    if(!$liked)
    {
        $this->addTracker($id_user,$id_pub);
        $repo = $entityManager->getRepository(Publication::class)->Like($id_pub);
    }
    else
    {
        $this->removeTracker($id_user,$id_pub);
        $repo = $entityManager->getRepository(Publication::class)->Dislike($id_pub);
    }
    return $this->redirectToRoute('publication_index');
}

    }
