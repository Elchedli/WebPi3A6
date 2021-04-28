<?php

namespace App\Controller;

use App\Entity\Suivi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExcelController extends AbstractController
{
    private $entityManager;
    public function __construct( EntityManagerInterface $entityManager,SessionInterface $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    private function getData(): array{
        $list = [];
        $suivis = $this->entityManager->getRepository(Suivi::class)->afficher();
        foreach($suivis as $suivi){
            $list[] = [
                $suivi->getClient(),
                $suivi->getTitreS(),
                $suivi->getDateDs(),
                $suivi->getDateFs(),
                $suivi->getTempsDs(),
                $suivi->getTempsFs(),
            ];
        }
        return $list;
    }

    /**
     * @Route("/export",  name="export")
     */
    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Liste des suivis pour '.$this->session->get('user'));
        $sheet->setCellValue('A1','Client');
        $sheet->setCellValue('B1','Titre');
        $sheet->setCellValue('C1','Date debut');
        $sheet->setCellValue('D1','Date Fin');
        $sheet->setCellValue('E1','Temps Debut');
        $sheet->setCellValue('F1','Temps Fin');
        $sheet->fromArray($this->getData(),null, 'A2', true);
        $writer = new Xlsx($spreadsheet);
        $writer->save($this->session->get("user")."(suivi).xlsx");
        return new JsonResponse("woah");
    }
}
