<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $isEnabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Xservice", inversedBy="appointments")
     */
    private $xService;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $xDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periodStart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periodEnd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="appointmentsStaff")
     */
    private $staffMember;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="appointmentsCustomer")
     */
    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getStaffMember(): ?User
    {
        return $this->staffMember;
    }

    public function setStaffMember(?User $staffMember): self
    {
        $this->staffMember = $staffMember;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getXService(): ?Xservice
    {
        return $this->xService;
    }

    public function setXService(?Xservice $xService): self
    {
        $this->xService = $xService;

        return $this;
    }

    public function getXDate(): ?\DateTimeInterface
    {
        return $this->xDate;
    }

    public function setXDate(?\DateTimeInterface $xDate): self
    {
        $this->xDate = $xDate;

        return $this;
    }

    public function getPeriodStart(): ?string
    {
        return $this->periodStart;
    }

    public function setPeriodStart(string $periodStart): self
    {
        $this->periodStart = $periodStart;

        return $this;
    }

    public function getPeriodEnd(): ?string
    {
        return $this->periodEnd;
    }

    public function setPeriodEnd(string $periodEnd): self
    {
        $this->periodEnd = $periodEnd;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(User $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
        }

        return $this;
    }

    public function removeCustomer(User $customer): self
    {
        if ($this->customers->contains($customer)) {
            $this->customers->removeElement($customer);
        }

        return $this;
    }

}
