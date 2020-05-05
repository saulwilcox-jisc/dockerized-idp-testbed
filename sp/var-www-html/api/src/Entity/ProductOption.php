<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductOptionRepository")
 */
class ProductOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product","productInstance"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductOptionType")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product","productInstance"})
     */
    private $productOptionType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductOptionGroup", inversedBy="productOptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productOptionGroup;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product","productInstance"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"product","productInstance"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductOptionChoice", mappedBy="productOption")
     * @Groups({"product","productInstance"})
     */
    private $productOptionChoices;

    public function __construct()
    {
        $this->productOptionChoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductOptionType(): ?ProductOptionType
    {
        return $this->productOptionType;
    }

    public function setProductOptionType(?ProductOptionType $productOptionType): self
    {
        $this->productOptionType = $productOptionType;

        return $this;
    }

    public function getProductOptionGroup(): ?ProductOptionGroup
    {
        return $this->productOptionGroup;
    }

    public function setProductOptionGroup(?ProductOptionGroup $productOptionGroup): self
    {
        $this->productOptionGroup = $productOptionGroup;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ProductOptionChoice[]
     */
    public function getProductOptionChoices(): Collection
    {
        return $this->productOptionChoices;
    }

    public function addProductOptionChoice(ProductOptionChoice $productOptionChoice): self
    {
        if (!$this->productOptionChoices->contains($productOptionChoice)) {
            $this->productOptionChoices[] = $productOptionChoice;
            $productOptionChoice->setProductOption($this);
        }

        return $this;
    }

    public function removeProductOptionChoice(ProductOptionChoice $productOptionChoice): self
    {
        if ($this->productOptionChoices->contains($productOptionChoice)) {
            $this->productOptionChoices->removeElement($productOptionChoice);
            // set the owning side to null (unless already changed)
            if ($productOptionChoice->getProductOption() === $this) {
                $productOptionChoice->setProductOption(null);
            }
        }

        return $this;
    }
}
