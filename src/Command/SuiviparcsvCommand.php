<?php

namespace App\Command;

use App\Entity\Suivi;
use App\Repository\SuiviRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
class SuiviparcsvCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private String $dataDirectory;
    private SymfonyStyle $io;
    private SuiviRepository $suiviRepository;
    public function __construct(EntityManagerInterface $entityManager,string $dataDirectory,SuiviRepository $suiviRepository){
        parent::__construct();
        $this->dataDirectory = $dataDirectory;
        $this->entityManager = $entityManager;
        $this->suiviRepository = $suiviRepository;
    }

    protected static $defaultName = 'app:creation-suivi';

    protected function configure(): void{
        $this->setDescription("Importer des données en provence d\'un fichier CSV");
    }
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input,$output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createSuivi();
        return Command::SUCCESS;
    }

    private function getDataFromfile():array{
        $file = $this->dataDirectory.'suivis.csv';
        $fileExtension = pathinfo($file,PATHINFO_EXTENSION);
        $normalizers = [new ObjectNormalizer()];
        $encoders = [
            new CsvEncoder(),
            new XmlEncoder(),
            new YamlEncoder()
        ];
        $serializer = new Serializer($normalizers,$encoders);
        /**
         * @var string $fileString
         */
        $fileString = file_get_contents($file);
        $data = $serializer->decode($fileString,$fileExtension);
        if(array_key_exists('results',$data)){
            return $data['results'];
        }
        return $data;
    }

    /**
     * @throws \Exception
     */
    private function createSuivi(): void{
        $this->io->section('Creation des suivis a partir du fichier');
        $suivicreated = 0;
        foreach($this->getDataFromfile() as $row){
            if(array_key_exists('titre',$row) && !empty($row['titre'])){
                $suivi = new Suivi();
                $suivi->setUsername($row['username']);
                $suivi->setClient($row['client']);
                $suivi->setTitreS($row['titre']);
//                $conversion = strtotime($row['datedeb']);
//                $conversion = date('Y-m-d',$conversion);
                $date = new DateTime($row['datedeb']);
                $suivi->setDateDs($date);
//                $conversion = strtotime($row['datefin']);
//                $newformat = date('Y-m-d',$conversion);
                $date = new DateTime($row['datefin']);
                $suivi->setDateFs($date);
                $date = new DateTime($row['temdeb']);
                $suivi->setTempsDs($date);
                $date = new DateTime($row['temfin']);
                $suivi->setTempsFs($date);
                $this->entityManager->persist($suivi);
                $suivicreated++;
            }
        }
        $this->entityManager->flush();
        if($suivicreated > 0){
            $string = "$suivicreated suivis creer dans la base de données.";
        }else{
            $string = 'Aucun suivi n\'a ete créer dans la base';
        }
        $this->io->success($string);
    }
}
