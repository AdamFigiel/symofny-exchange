<?php
namespace App\Tests\unit\ExchangeRateUpdater;

use App\Models\ExchangeRateUpdater\NbpExtractor;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

class NbpExtractorTest extends TestCase
{

    public function testValidationArray()
    {
        $nbpExtractor = new NbpExtractor();
        $firstRate = $nbpExtractor->getRates()[0];

        $validCode = isset($firstRate['code']);
        $validMid = isset($firstRate['mid']);
        $validCurrency = isset($firstRate['currency']);

        $this->assertTrue($validCode);
        $this->assertTrue($validMid);
        $this->assertTrue($validCurrency);
    }

    public function testReturnedTypes()
    {
        $nbpExtractor = new NbpExtractor();

        $this->assertTrue(is_array($nbpExtractor->getRates()));
        $this->assertTrue($nbpExtractor->getEffectiveDate() instanceof DateTimeInterface);
    }

}
