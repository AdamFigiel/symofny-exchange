<?php
namespace App\Models\ExchangeRateUpdater;

use App\Entity\ExchangeRate;
use App\Entity\ExchangeRateUpdater;
use Doctrine\ORM\EntityManagerInterface;

class Updater
{
    private $extractor;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ExtractorInterface $extractor)
    {
        $this->extractor = $extractor;
        $this->entityManager = $entityManager;
    }

    public function update(): void
    {
        $exchangeRateRepository = $this->entityManager->getRepository(ExchangeRate::class);

        foreach ($this->extractor->getRates() as $exchangeRateParams){

            $exchangeRate = $exchangeRateRepository->findOneBy(['code' => $exchangeRateParams['code']]);
            if(!$exchangeRate){
                $exchangeRate = new ExchangeRate();
            }

            $exchangeRate->setCode($exchangeRateParams['code']);
            $exchangeRate->setCurrency($exchangeRateParams['currency']);
            $exchangeRate->setMid($exchangeRateParams['mid']);


            $this->entityManager->persist($exchangeRate);
            $this->entityManager->flush();
        }


        $exchangeRateUpdater = new ExchangeRateUpdater();
        $exchangeRateUpdater->setExecutedDate(new \DateTime());
        $exchangeRateUpdater->setEffectiveDate($this->extractor->getEffectiveDate());
        $this->entityManager->persist($exchangeRateUpdater);
        $this->entityManager->flush();

    }

    public function isNeedUpdate(): bool
    {
        $exchangeRateUpdaterRepository = $this->entityManager->getRepository(ExchangeRateUpdater::class);

        if($exchangeRateUpdaterRepository->findByOlderOrSameDate($this->extractor->getEffectiveDate())){
            return false;
        }

        return true;
    }



}
