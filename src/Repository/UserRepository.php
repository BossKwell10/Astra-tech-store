<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function findByRole(string $role): array
    {
        $entityManager = $this->getEntityManager();

        // Requête SQL native pour récupérer les utilisateurs avec un rôle spécifique
        $sql = 'SELECT u.* FROM user u WHERE JSON_CONTAINS(u.roles, :role) = 1';

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(User::class, 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'roles', 'roles');
        $rsm->addFieldResult('u', 'username', 'username');
        $rsm->addFieldResult('u', 'password', 'password');
        $rsm->addFieldResult('u', 'uuid', 'uuid');
        $rsm->addFieldResult('u', 'createdAt', 'createdAt');
        $rsm->addFieldResult('u', 'updatedAt', 'updatedAt');

        // Exécution de la requête native
        $result = $entityManager->createNativeQuery($sql, $rsm)
            ->setParameter('role', json_encode([$role]))  // Encode le rôle en JSON
            ->getResult();

        // Vérification et initialisation des propriétés null
        foreach ($result as $user) {

            if ($user->getCreatedAt() === null) {
                $user->setCreatedAt(new \DateTime()); // Initialisation si null
            }
            if ($user->getUpdatedAt() === null) {
                $user->setUpdatedAt(new \DateTime()); // Initialisation si null
            }
        }

        return $result;
    }

    public function findByType(mixed $type): ?array
    {
        return $this->createQueryBuilder('u')
            ->where('u.typeUser in (:type)')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }


}
