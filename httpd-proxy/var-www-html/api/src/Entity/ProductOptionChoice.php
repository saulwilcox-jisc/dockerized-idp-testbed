<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductOptionChoiceRepository")
 */
class ProductOptionChoice
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"product","productInstance"})
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductOption", inversedBy="productOptionChoices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productOption;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getProductOption(): ?ProductOption
    {
        return $this->productOption;
    }

    public function setProductOption(?ProductOption $productOption): self
    {
        $this->productOption = $productOption;

        return $this;
    }
}
