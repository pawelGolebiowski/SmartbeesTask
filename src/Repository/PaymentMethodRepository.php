<?php

namespace App\Repository;

use App\Entity\PaymentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaymentMethod>
 *
 * @method PaymentMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentMethod[]    findAll()
 * @method PaymentMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentMethod::class);
    }

    public function findRelatedPaymentMethodsByIds(int $id): ?string
    {
        $result = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->andWhere('p.isActive = :isActive')
            ->setParameter('id', $id)
            ->setParameter('isActive', true)
            ->getQuery()
            ->getOneOrNullResult();

        return $result ? $result->getName() : null;
    }
}
