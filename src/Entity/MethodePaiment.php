<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MethodePaimentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MethodePaimentRepository::class)
 */
class MethodePaiment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 20,
     *      minMessage = "elle doit avoir {{ limit }} chiffres",
     *      maxMessage = "elle doit avoir {{ limit }} chiffres")
     */
    private $methode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 20,
     *      minMessage = "elle doit avoir {{ limit }} chiffres",
     *      maxMessage = "elle doit avoir {{ limit }} chiffres")
     */
    private $type_paiment;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, mappedBy="paiment", cascade={"persist", "remove"})
     */
    private $facture;
/**
 * @return int
 */
    public function getId(): ?int
    {
        return $this->id;
    }
/**
 * @return string
 */
    public function getMethode(): ?string
    {
        return $this->methode;
    }
/**
 * @param string $methode
 * @return MethodePaiment
 */
    public function setMethode(string $methode): self
    {
        $this->methode = $methode;

        return $this;
    }
/**
 * @return string
 */
    public function getTypePaiment(): ?string
    {
        return $this->type_paiment;
    }
/**
 * @param string $type_paiment
 * @return MethodePaiment
 */
    public function setTypePaiment(string $type_paiment): self
    {
        $this->type_paiment = $type_paiment;

        return $this;
    }
public function __toString(){
    return $this->methode;
}
    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        // unset the owning side of the relation if necessary
        if ($facture === null && $this->facture !== null) {
            $this->facture->setPaiment(null);
        }

        // set the owning side of the relation if necessary
        if ($facture !== null && $facture->getPaiment() !== $this) {
            $facture->setPaiment($this);
        }

        $this->facture = $facture;

        return $this;
    }
}
