<?php

namespace App\Repository;

use App\Entity\ExchangeRateUpdater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExchangeRateUpdater|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExchangeRateUpdater|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExchangeRateUpdater[]    findAll()
 * @method ExchangeRateUpdater[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExchangeRateUpdaterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExchangeRateUpdater::class);
    }

    public function findByOlderOrSameDate($date): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.effectiveDate >= :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }

}
