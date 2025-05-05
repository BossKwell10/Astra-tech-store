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
            'p.id as product_id',
            'p.imageUrl as image_url',
            'p.name as product_name',
            'p.price as product_price',
        ]);

        return $qb->getQuery()->getResult();
    }

    public function findWithFilters(array $filtres): array
    {
        $qb = $this->createQueryBuilder('p')
            ->select([
                'p.id as product_id',
                'p.imageUrl as image_url',
                'p.name as product_name',
                'p.price as product_price',
            ])
            ->join('p.type', 'type')
            ->join('type.categorie', 'c');
        if (!empty($filtres['categorie']) && ctype_digit($filtres['categorie'])) {
            $qb->andWhere('c.id = :cat')
                ->setParameter('cat', $filtres['categorie']);
        }

        if (isset($filtres['disponible']) && $filtres['disponible'] !== '') {
            $qb->andWhere('p.stock = :dispo')
                ->setParameter('dispo', (bool)$filtres['disponible']);
        }

        if (!empty($filtres['prix_min'])) {
            $qb->andWhere('p.price >= :min')
                ->setParameter('min', $filtres['prix_min']);
        }

        if (!empty($filtres['prix_max'])) {
            $qb->andWhere('p.price <= :max')
                ->setParameter('max', $filtres['prix_max']);
        }

        if (!empty($filtres['search'])) {
            $qb->andWhere('LOWER(p.name) LIKE :search')
                ->setParameter('search', '%' . strtolower($filtres['search']) . '%');
        }

        if (!empty($filtres['tri'])) {
            switch ($filtres['tri']) {
                case 'prix_asc':
                    $qb->orderBy('p.price', 'ASC');
                    break;
                case 'prix_desc':
                    $qb->orderBy('p.price', 'DESC');
                    break;
                case 'date':
                    $qb->orderBy('p.createdAt', 'DESC');
                    break;
            }
        }

        return $qb->getQuery()->getResult();
    }

}
