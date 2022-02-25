<?php

namespace App\Entity;

use App\Repository\XserviceCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=XserviceCategoryRepository::class)
 */
class XserviceCategory
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Xservice", mappedBy="category")
     */
    private $xServices;

    public function __construct()
    {
        $this->xServices = new ArrayCollection();
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

   public function addService(Xservice $xService): self
    {
        if (!$this->products->contains($xService)) {
            $this->products[] = $xService;
            $xService->setXServiceCategory($this);
        }

        return $this;
    }

    public function removeService(Xservice $xService): self
    {
        if ($this->products->contains($xService)) {
            $this->products->removeElement($xService);
            // set the owning side to null (unless already changed)
            if ($xService->getXServiceCategory() === $this) {
                $xService->setXServiceCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Xservice[]
     */
    public function getXServices(): Collection
    {
        return $this->xServices;
    }

    public function addXService(Xservice $xService): self
    {
        if (!$this->xServices->contains($xService)) {
            $this->xServices[] = $xService;
            $xService->setCategory($this);
        }

        return $this;
    }

    public function removeXService(Xservice $xService): self
    {
        if ($this->xServices->contains($xService)) {
            $this->xServices->removeElement($xService);
            // set the owning side to null (unless already changed)
            if ($xService->getCategory() === $this) {
                $xService->setCategory(null);
            }
        }

        return $this;
    }

}
