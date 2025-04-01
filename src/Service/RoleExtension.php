<?php

namespace App\Service;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RoleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('role_label', [$this, 'getRoleLabel']),
        ];
    }

    public function getRoleLabel(string $role): string
    {
        $rolesMap = [
            'ROLE_GESTIONNAIRE' => 'Gestionnaire',
            'ROLE_ADMIN' => 'Administrateur',
        ];

        return $rolesMap[$role] ?? $role;
    }
}

