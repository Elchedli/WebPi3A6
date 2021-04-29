<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Entity\login;
use App\Entity\Nutri;
use App\Entity\Psycho;
use App\Entity\Simple;
use App\Entity\Suivi;
use App\Form\loginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/login")
 */
class LoginController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/simple", name="simple_login")
     */
    public function loginsimple(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'simple');
            if($exist){
                $user=$em->getRepository(Simple::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getIdUser());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','simple');
                return $this->redirectToRoute('acceuil');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/psycho", name="psy_login")
     */
    public function loginpsycho(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'psycho');
            if($exist){
                $user=$em->getRepository(Psycho::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getId());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','psycho');
                return $this->redirectToRoute('acceuil');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/coach", name="coach_login")
     */
    public function logincoach(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'coach');
            if($exist){
                $user=$em->getRepository(Coach::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getId());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','coach');
                return $this->redirectToRoute('acceuil');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nutri", name="nutri_login")
     */
    public function loginnutri(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'nutri');
            if($exist){
                $user=$em->getRepository(Nutri::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getId());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','nutri');
                return $this->redirectToRoute('acceuil');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion_login")
     */
    public function deconnexion(): Response{
        $this->session->set('id_user','');
        $this->session->set('user','');
        $this->session->set('type','');
        return $this->redirectToRoute('acceuil');
    }


    /**
     * @Route("/psychoadmin", name="login2_psy")
     */
    public function login2psycho(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'psycho');
            if($exist){
                $user=$em->getRepository(Psycho::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getId());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','psycho');
                return $this->redirectToRoute('acceuilback2');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/coachadmin", name="login2_coach")
     */
    public function login2coach(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'coach');
            if($exist){
                $user=$em->getRepository(Coach::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getId());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','coach');
                return $this->redirectToRoute('acceuilback2');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nutriadmin", name="login2_nutri")
     */
    public function login2nutri(Request $request): Response{
        $login = new login();
        $form = $this->createForm(loginType::class,$login);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $exist = $em->getRepository( Suivi::class)->verifieruser($login,'nutri');
            if($exist){
                $user=$em->getRepository(Nutri::class)->findOneBy(['username'=>$login->getUsername()]);
                $this->session->set('id_user',$user->getId());
                $this->session->set('user',$login->getUsername());
                $this->session->set('type','nutri');
                return $this->redirectToRoute('acceuilback2');
            }
        }
        return $this->render('login/login.html.twig', [
            'login' => $login,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deconnexionadmin", name="login2_deconnexion")
     */
    public function deconnexion2(): Response{
        $this->session->set('id_user','');
        $this->session->set('user','');
        $this->session->set('type','');
        return $this->redirectToRoute('acceuilback2');
    }
}
