<?php

namespace App\Repository;

use App\Entity\DiscountCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiscountCode>
 *
 * @method DiscountCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscountCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscountCode[]    findAll()
 * @method DiscountCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscountCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscountCode::class);
    }

    public function findActiveCode(): ?DiscountCode
    {
        return $this->createQueryBuilder('dc')
            ->andWhere('dc.isActive = :isActive')
            ->setParameter('isActive', true)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
