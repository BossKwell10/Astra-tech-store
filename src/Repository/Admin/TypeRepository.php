<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type>
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function findCategories(): ?array
    {
        return $this->createQueryBuilder('t')
            ->select([
                'c.name as category_name',
            ])
            ->join('t.categorie', 'c')
            ->groupBy('c.name')
            ->getQuery()
            ->getResult();
    }

}
