<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ApiResource(normalizationContext={"groups"={"product"}})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Gedmo\Loggable
 */
class Product
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
     * @Gedmo\Versioned
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductStep", mappedBy="product")
     * @Groups({"product","productInstance"})
     */
    private $productSteps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductOptionGroup", mappedBy="product")
     * @Groups({"product","productInstance"})
     */
    private $productOptionGroups;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PaymentMethod")
     */
    private $paymentMethods;

    public function __construct()
    {
        $this->productSteps = new ArrayCollection();
        $this->productOptionGroups = new ArrayCollection();
        $this->paymentMethods = new ArrayCollection();
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

    /**
     * @return Collection|ProductStep[]
     */
    public function getProductSteps(): Collection
    {
        return $this->productSteps;
    }

    public function addProductStep(ProductStep $productStep): self
    {
        if (!$this->productSteps->contains($productStep)) {
            $this->productSteps[] = $productStep;
            $productStep->setProduct($this);
        }

        return $this;
    }

    public function removeProductStep(ProductStep $productStep): self
    {
        if ($this->productSteps->contains($productStep)) {
            $this->productSteps->removeElement($productStep);
            // set the owning side to null (unless already changed)
            if ($productStep->getProduct() === $this) {
                $productStep->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductOptionGroup[]
     */
    public function getProductOptionGroups(): Collection
    {
        return $this->productOptionGroups;
    }

    public function addProductOptionGroup(ProductOptionGroup $productOptionGroup): self
    {
        if (!$this->productOptionGroups->contains($productOptionGroup)) {
            $this->productOptionGroups[] = $productOptionGroup;
            $productOptionGroup->setProduct($this);
        }

        return $this;
    }

    public function removeProductOptionGroup(ProductOptionGroup $productOptionGroup): self
    {
        if ($this->productOptionGroups->contains($productOptionGroup)) {
            $this->productOptionGroups->removeElement($productOptionGroup);
            // set the owning side to null (unless already changed)
            if ($productOptionGroup->getProduct() === $this) {
                $productOptionGroup->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PaymentMethod[]
     */
    public function getPaymentMethods(): Collection
    {
        return $this->paymentMethods;
    }

    public function addPaymentMethod(PaymentMethod $paymentMethod): self
    {
        if (!$this->paymentMethods->contains($paymentMethod)) {
            $this->paymentMethods[] = $paymentMethod;
        }

        return $this;
    }

    public function removePaymentMethod(PaymentMethod $paymentMethod): self
    {
        if ($this->paymentMethods->contains($paymentMethod)) {
            $this->paymentMethods->removeElement($paymentMethod);
        }

        return $this;
    }
}
