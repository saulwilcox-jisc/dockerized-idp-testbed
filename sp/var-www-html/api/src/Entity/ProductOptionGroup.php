<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductOptionGroupRepository")
 */
class ProductOptionGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product","productInstance"})
     */
    private $id;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productOptionGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductOption", mappedBy="productOptionGroup")
     * @Groups({"product","productInstance"})
     */
    private $productOptions;

    public function __construct()
    {
        $this->productOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection|ProductOption[]
     */
    public function getProductOptions(): Collection
    {
        return $this->productOptions;
    }

    public function addProductOption(ProductOption $productOption): self
    {
        if (!$this->productOptions->contains($productOption)) {
            $this->productOptions[] = $productOption;
            $productOption->setProductOptionGroup($this);
        }

        return $this;
    }

    public function removeProductOption(ProductOption $productOption): self
    {
        if ($this->productOptions->contains($productOption)) {
            $this->productOptions->removeElement($productOption);
            // set the owning side to null (unless already changed)
            if ($productOption->getProductOptionGroup() === $this) {
                $productOption->setProductOptionGroup(null);
            }
        }

        return $this;
    }
}
