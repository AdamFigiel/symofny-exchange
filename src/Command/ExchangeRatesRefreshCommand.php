<?php

namespace App\Command;

use App\Models\ExchangeRateUpdater\Updater;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExchangeRatesRefreshCommand extends Command
{
    protected static $defaultName = 'app:refresh-exchange-rates';
    private const DESCRIPTION = 'Update eXchange rates';

    private $entityManager;
    private $updater;

    public function __construct(EntityManagerInterface $entityManager, Updater $updater)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->updater = $updater;
    }

    protected function configure()
    {
        $this->setDescription(self::DESCRIPTION);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if($this->updater->isNeedUpdate()){
            $this->updater->update();
            $io->success("Exchange Rate updated");
            return Command::SUCCESS;
        }

        $io->success("Exchange Rate not need update");
        return Command::SUCCESS;
    }
}
