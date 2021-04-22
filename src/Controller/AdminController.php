<?php

namespace App\Controller;

use App\Entity\Act;
use App\Entity\Evenement;
use App\Repository\ActivitephpRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexEv (): Response
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/indexAdmin.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * @Route("/{idEv}/show", name="evenement_showAA", methods={"GET"})
     */
    public function showEv (Evenement $evenement): Response
    {
        return $this->render('evenement/showAdmin.html.twig', [
            'evenement' => $evenement,
        ]);
    }
    /**
     * @Route("/activite", name="act_indexAc", methods={"GET"})
     */
    public function indexAcc (): Response
    {
        $acts = $this->getDoctrine()
            ->getRepository(Act::class)
            ->findAll();

        return $this->render('act/indexAdmin.html.twig', [
            'acts' => $acts,
        ]);
    }
    /**
     * @Route("/{idAct}/activite/affiche", name="act_showAAc", methods={"GET"})
     */
    public function showAcc(Act $act): Response
    {
        return $this->render('act/showAdmin.html.twig', [
            'act' => $act,
        ]);
    }
    /**
     * @param EvenementRepository $EvenementRepository
     * @return Response
     * @Route("/admin/statstique", name="Statistique")
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

    /**
     * @param ActivitephpRepository $ActivitephpRepository
     * @return Response
     * @Route("/activite/stat", name="Stat")
     */
    public function ActStat(ActivitephpRepository $ActivitephpRepository)
    {
        $activites = $ActivitephpRepository->findAll();
        $categTy= ["yoga" , "meditation" , "musique"];
        $categC = ["#a65959" , "#414e4d" , "#5E8486"];
        $categYoga= count($ActivitephpRepository->findBy(["typeAct" =>"yoga"]) )  ;
        $categMéditation = count($ActivitephpRepository->findBy(["typeAct" =>"meditation"]) ) ;
        $categMusique = count($ActivitephpRepository->findBy(["typeAct" => "musique"]) ) ;
        $categCount1 = [ $categYoga , $categMéditation , $categMusique ];

        return $this->render('act/stat.html.twig',
            ['categTy' => json_encode($categTy),
                'categC' => json_encode($categC),
                'categCount1' => json_encode($categCount1),


            ]);
    }
}

