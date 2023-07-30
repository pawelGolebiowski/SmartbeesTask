<?php

namespace App\Repository;

use App\Entity\OrderSummary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderSummary>
 *
 * @method OrderSummary|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderSummary|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderSummary[]    findAll()
 * @method OrderSummary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderSummaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderSummary::class);
    }
}
