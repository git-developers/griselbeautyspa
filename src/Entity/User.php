<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 */
class User implements UserInterface
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(name="email", type="string", length=180, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $roles = []; // @ORM\Column(type="json")

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="users", cascade={"persist"})
     */
    private $profile;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $isEnabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="staffMember")
     */
    private $appointmentsStaff;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Appointment", mappedBy="customers")
     */
    private $appointmentsCustomer;

    public function __construct()
    {
        $this->appointmentsStaff = new ArrayCollection();
        $this->appointmentsCustomer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = json_decode($this->roles);
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = json_encode($roles);

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->name . " " . $this->lastName;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointmentsStaff(): Collection
    {
        return $this->appointmentsStaff;
    }

    public function addAppointmentsStaff(Appointment $appointmentsStaff): self
    {
        if (!$this->appointmentsStaff->contains($appointmentsStaff)) {
            $this->appointmentsStaff[] = $appointmentsStaff;
            $appointmentsStaff->setStaffMember($this);
        }

        return $this;
    }

    public function removeAppointmentsStaff(Appointment $appointmentsStaff): self
    {
        if ($this->appointmentsStaff->contains($appointmentsStaff)) {
            $this->appointmentsStaff->removeElement($appointmentsStaff);
            // set the owning side to null (unless already changed)
            if ($appointmentsStaff->getStaffMember() === $this) {
                $appointmentsStaff->setStaffMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointmentsCustomer(): Collection
    {
        return $this->appointmentsCustomer;
    }

    public function addAppointmentsCustomer(Appointment $appointmentsCustomer): self
    {
        if (!$this->appointmentsCustomer->contains($appointmentsCustomer)) {
            $this->appointmentsCustomer[] = $appointmentsCustomer;
            $appointmentsCustomer->addCustomer($this);
        }

        return $this;
    }

    public function removeAppointmentsCustomer(Appointment $appointmentsCustomer): self
    {
        if ($this->appointmentsCustomer->contains($appointmentsCustomer)) {
            $this->appointmentsCustomer->removeElement($appointmentsCustomer);
            $appointmentsCustomer->removeCustomer($this);
        }

        return $this;
    }
}
