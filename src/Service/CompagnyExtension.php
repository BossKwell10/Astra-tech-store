<?php

namespace App\Service;

use App\Entity\Campagny;
use App\Repository\CampagnyRepository;

readonly class CompagnyExtension
{
    public function __construct(private CampagnyRepository $campagnyRepository)
    {
    }


    public function getEntreprise(): ?Campagny
    {
        return $this->campagnyRepository->findOneBy([], ['id' => 'ASC']);

    }
}