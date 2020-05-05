<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"salesforceContacts"}})
 * @ApiFilter(SearchFilter::class, properties={
 *     "productInstance": "exact"
 * })
 * @ORM\Entity(repositoryClass="App\Repository\ProductInstanceSalesforceContactRepository")
 */
class ProductInstanceSalesforceContact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"salesforceContacts"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductInstance", inversedBy="productInstanceSalesforceContacts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"salesforceContacts"})
     */
    private $productInstance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SalesforceContact")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"salesforceContacts"})
     */
    private $salesforceContact;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"salesforceContacts"})
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductInstance(): ?ProductInstance
    {
        return $this->productInstance;
    }

    public function setProductInstance(?ProductInstance $productInstance): self
    {
        $this->productInstance = $productInstance;

        return $this;
    }

    public function getSalesforceContact(): ?SalesforceContact
    {
        return $this->salesforceContact;
    }

    public function setSalesforceContact(?SalesforceContact $salesforceContact): self
    {
        $this->salesforceContact = $salesforceContact;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
