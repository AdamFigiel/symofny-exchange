<?php
namespace App\Models\ExchangeRateUpdater;

class NbpExtractor implements ExtractorInterface
{
    private const URL = 'http://api.nbp.pl/api/exchangerates/tables/A/';

    private $effectiveDate = null;
    private $rates = [];

    public function __construct()
    {
        $this->loadData();
    }

    public function getRates(): array
    {
        return $this->rates;
    }

    public function getEffectiveDate(): ?\DateTimeInterface
    {
        return $this->effectiveDate ? new \DateTime($this->effectiveDate) : null;
    }

    private function loadData(): array
    {
        $data = $this->getDataFromUrl();

        if(!isset($data[0]) || !isset($data[0]["rates"]) || !isset($data[0]['effectiveDate'])){
            throw new \Exception("Data not valid!");
        }

        $this->rates = $data[0]["rates"];
        $this->effectiveDate = $data[0]['effectiveDate'];

        return $data;
    }

    private function getDataFromUrl(): array
    {
        $json = file_get_contents(self::URL);
        try {
            $data = json_decode($json, true);
        } catch (\Exception $e){
            throw new \Exception("Content from url error!");
        }

        return $data;
    }
}
