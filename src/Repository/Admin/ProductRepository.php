<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function findBySomeField(int $value): ?array
    {
        return $this->createQueryBuilder('p')
            ->select([
                'COUNT(p.id) as total_products',
                'c.name',
            ])
            ->join('p.type', 'type')
            ->join('type.categorie', 'c')
            ->where('c.id = :categorie_id')
            ->andWhere('p.stock > 0')
            ->setParameter('categorie_id', $value)
            ->getQuery()
            ->getResult();
    }

    public function findByFilters(): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select([
            'p.imageUrl as image_url',
            'p.name as product_name',
            'p.price as product_price',
        ]);

        return $qb->getQuery()->getResult();
    }
}
