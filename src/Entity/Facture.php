<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank
     */
    private $nom_user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $prenom_user;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     *  @Assert\Length(
     *      min = 5,
     *      max = 7,
     *      minMessage = "Matricule doit avoir {{ limit }} chiffres",
     *      maxMessage = "Matricule doit avoir {{ limit }} chiffres")
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     *  @Assert\Length(
     *      min = 1,
     *      max = 8,
     *      minMessage = "Code doit avoir {{ limit }} chiffres",
     *      maxMessage = "Code doit avoir {{ limit }} chiffres")
     *
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $date_fin;

    /**
     * @ORM\OneToOne(targetEntity=MethodePaiment::class, inversedBy="facture", cascade={"persist", "remove"})
     */
    private $paiment;
/**
 * @return integer
 */
    public function getId(): ?int
    {
        return $this->id;
    }
/**
 * @return string
 */
    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }
/**
 * @param string $nom_user
 * @return Facture
 */
    public function setNomUser(string $nom_user): self
    {
        $this->nom_user = $nom_user;

        return $this;
    }
/**
 *@return string
 */
    public function getPrenomUser(): ?string
    {
        return $this->prenom_user;
    }
/**
 *@param string $prenom_user
  * @return Facture
 */
    public function setPrenomUser(string $prenom_user): self
    {
        $this->prenom_user = $prenom_user;

        return $this;
    }
/**
 * @return string
 */
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }
/**
 * @param string $Matricule
  * @return Facture
 */
    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }
/**
 * @return string
 */
    public function getCode(): ?string
    {
        return $this->code;
    }
/**
 * @param string $code
 * @return Facture
 */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
/**
 * @return int
 */
    public function getPrix(): ?int
    {
        return $this->prix;
    }
/**
 * @param int $prix
 *  @return Facture
 */
    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
/**
 * @return date
 */
    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }
/**
 * @param date $date_debut
 * @return Facture
 */
    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }
/**
 * @return date
 */
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }
/**
 * @param date $date_fin
 * @return Facture
 */
    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }
public function __toString(){
    return $this->code;
}
    public function getPaiment(): ?MethodePaiment
    {
        return $this->paiment;
    }

    public function setPaiment(?MethodePaiment $paiment): self
    {
        $this->paiment = $paiment;

        return $this;
    }
}
