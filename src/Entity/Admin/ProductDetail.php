<?php

namespace App\Entity\Admin;

use App\Repository\Admin\ProductDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductDetailRepository::class)]
class ProductDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'productDetail', cascade: ['persist', 'remove'])]
    private ?Product $product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modele = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $processeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stockage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $carteGraphique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $osInstalle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tailleEcran = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resolution = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $claviers = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $webcam = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $connexionWifi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lecteurOption = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ports = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dimension = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poids = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fournisAvec = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getProcesseur(): ?string
    {
        return $this->processeur;
    }

    public function setProcesseur(?string $processeur): static
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(?string $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStockage(): ?string
    {
        return $this->stockage;
    }

    public function setStockage(?string $stockage): static
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getCarteGraphique(): ?string
    {
        return $this->carteGraphique;
    }

    public function setCarteGraphique(?string $carteGraphique): static
    {
        $this->carteGraphique = $carteGraphique;

        return $this;
    }

    public function getOsInstalle(): ?string
    {
        return $this->osInstalle;
    }

    public function setOsInstalle(?string $osInstalle): static
    {
        $this->osInstalle = $osInstalle;

        return $this;
    }

    public function getTailleEcran(): ?string
    {
        return $this->tailleEcran;
    }

    public function setTailleEcran(?string $tailleEcran): static
    {
        $this->tailleEcran = $tailleEcran;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setResolution(?string $resolution): static
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function getClaviers(): ?string
    {
        return $this->claviers;
    }

    public function setClaviers(?string $claviers): static
    {
        $this->claviers = $claviers;

        return $this;
    }

    public function getWebcam(): ?string
    {
        return $this->webcam;
    }

    public function setWebcam(?string $webcam): static
    {
        $this->webcam = $webcam;

        return $this;
    }

    public function getConnexionWifi(): ?string
    {
        return $this->connexionWifi;
    }

    public function setConnexionWifi(?string $connexionWifi): static
    {
        $this->connexionWifi = $connexionWifi;

        return $this;
    }

    public function getLecteurOption(): ?string
    {
        return $this->lecteurOption;
    }

    public function setLecteurOption(?string $lecteurOption): static
    {
        $this->lecteurOption = $lecteurOption;

        return $this;
    }

    public function getPorts(): ?string
    {
        return $this->ports;
    }

    public function setPorts(?string $ports): static
    {
        $this->ports = $ports;

        return $this;
    }

    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    public function setDimension(?string $dimension): static
    {
        $this->dimension = $dimension;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(?string $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getFournisAvec(): ?string
    {
        return $this->fournisAvec;
    }

    public function setFournisAvec(?string $fournisAvec): static
    {
        $this->fournisAvec = $fournisAvec;

        return $this;
    }
}
