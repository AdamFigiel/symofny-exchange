<?php

namespace App\Entity;

use App\Repository\ExchangeRateUpdaterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExchangeRateUpdaterRepository::class)
 */
class ExchangeRateUpdater
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $executedDate;

    /**
     * @ORM\Column(type="date")
     */
    private $effectiveDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExecutedDate(): ?\DateTimeInterface
    {
        return $this->executedDate;
    }

    public function setExecutedDate(\DateTimeInterface $executedDate): self
    {
        $this->executedDate = $executedDate;

        return $this;
    }

    public function getEffectiveDate(): ?\DateTimeInterface
    {
        return $this->effectiveDate;
    }

    public function setEffectiveDate(\DateTimeInterface $effectiveDate): self
    {
        $this->effectiveDate = $effectiveDate;

        return $this;
    }
}
