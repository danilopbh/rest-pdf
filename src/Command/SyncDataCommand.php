<?php

namespace App\Command;

use App\Controller\DataCopyController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SyncDataCommand extends Command{
    protected static $defaultName = 'app:sync-data';
    private $entityManager;
    private $dataCopyController;

    public function __construct(EntityManagerInterface $entityManager, DataCopyController $dataCopyController){
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->dataCopyController = $dataCopyController;
    }

    protected function configure(): void{
        $this->setDescription('Sincronizar os dados de cda_siatu e contribuinte_siatu com cda_supp e contribuinte_supp.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int{
        $io = new SymfonyStyle($input, $output);

        //Chamando o método que copia os dados no nosso Controller
        $this->dataCopyController->copyData($this->entityManager);

        $io->success('Sincronização de dados concluída com sucesso!');

        return Command::SUCCESS;
    }
}