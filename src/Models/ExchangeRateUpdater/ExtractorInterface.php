<?php
namespace App\Models\ExchangeRateUpdater;

interface ExtractorInterface
{
    public function getRates():array;
    public function getEffectiveDate(): ?\DateTimeInterface;
}
