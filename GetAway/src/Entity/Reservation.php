<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_act", columns={"id_activite"}), @ORM\Index(name="id_vol", columns={"id_vol"}), @ORM\Index(name="fk_client", columns={"id_client"}), @ORM\Index(name="fk_heb", columns={"id_hebergement"}), @ORM\Index(name="fk_voyage", columns={"id_voyage"})})
 *@ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=false)
     */
    private $dateReservation;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_place", type="integer", nullable=false)
     * @Assert\GreaterThanOrEqual(
     *value=1,
     *message="le nombre de place doit etre superieur ou egale a 1 ")
     * groups={"VVA"}
     */
    private $nbrPlace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     * @Assert\GreaterThan("today")
     * groups={"Hebergement"}
     *
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     *@Assert\Expression(
     * "this.getDateDebut()<this.getDateFin()",
     *  message="La date fin ne doit pas être antérieure à la date début",
     * groups={"Hebergement"}
     *)
     *
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=30, nullable=false)
     */
    private $etat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=true)
     */
    private $type;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    /**
     * @var \Voyageorganise
     *
     * @ORM\ManyToOne(targetEntity="Voyageorganise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_voyage", referencedColumnName="idVoy")
     * })
     */
    private $idVoyage;

    /**
     * @var \Activite
     *
     * @ORM\ManyToOne(targetEntity="Activite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activite", referencedColumnName="RefAct")
     * })
     */
    private $idActivite;

    /**
     * @var \Hebergement
     *
     * @ORM\ManyToOne(targetEntity="Hebergement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hebergement", referencedColumnName="referance")
     * })
     */
    private $idHebergement;

    /**
     * @var \Vol
     *
     * @ORM\ManyToOne(targetEntity="Vol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vol", referencedColumnName="id_vol")
     * })
     */
    private $idVol;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="idReservation", orphanRemoval=true)
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdClient(): ?User
    {
        return $this->idClient;
    }

    public function setIdClient(?User $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdVoyage(): ?Voyageorganise
    {
        return $this->idVoyage;
    }

    public function setIdVoyage(?Voyageorganise $idVoyage): self
    {
        $this->idVoyage = $idVoyage;

        return $this;
    }

    public function getIdActivite(): ?Activite
    {
        return $this->idActivite;
    }

    public function setIdActivite(?Activite $idActivite): self
    {
        $this->idActivite = $idActivite;

        return $this;
    }

    public function getIdHebergement(): ?Hebergement
    {
        return $this->idHebergement;
    }

    public function setIdHebergement(?Hebergement $idHebergement): self
    {
        $this->idHebergement = $idHebergement;

        return $this;
    }

    public function getIdVol(): ?Vol
    {
        return $this->idVol;
    }

    public function setIdVol(?Vol $idVol): self
    {
        $this->idVol = $idVol;

        return $this;
    }

    /**
     * @return Collection<int, Paiement>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Paiement $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setIdReservation($this);
        }

        return $this;
    }

    public function removeReservation(Paiement $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdReservation() === $this) {
                $reservation->setIdReservation(null);
            }
        }

        return $this;
    }


}