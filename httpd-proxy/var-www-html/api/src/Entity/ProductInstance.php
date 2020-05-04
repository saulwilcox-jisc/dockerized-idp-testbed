<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"productInstance"}})
 * @ORM\Entity(repositoryClass="App\Repository\ProductInstanceRepository")
 */
class ProductInstance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"productInstance"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"productInstance"})
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"productInstance"})
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductInstanceSalesforceContact", mappedBy="productInstance")
     */
    private $productInstanceSalesforceContacts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $invoiceContact;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="productInstance")
     */
    private $contacts;

    public function __construct()
    {
        $this->productInstanceSalesforceContacts = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

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
     * @return Collection|ProductInstanceSalesforceContact[]
     */
    public function getProductInstanceSalesforceContacts(): Collection
    {
        return $this->productInstanceSalesforceContacts;
    }

    public function addProductInstanceSalesforceContact(ProductInstanceSalesforceContact $productInstanceSalesforceContact): self
    {
        if (!$this->productInstanceSalesforceContacts->contains($productInstanceSalesforceContact)) {
            $this->productInstanceSalesforceContacts[] = $productInstanceSalesforceContact;
            $productInstanceSalesforceContact->setProductInstance($this);
        }

        return $this;
    }

    public function removeProductInstanceSalesforceContact(ProductInstanceSalesforceContact $productInstanceSalesforceContact): self
    {
        if ($this->productInstanceSalesforceContacts->contains($productInstanceSalesforceContact)) {
            $this->productInstanceSalesforceContacts->removeElement($productInstanceSalesforceContact);
            // set the owning side to null (unless already changed)
            if ($productInstanceSalesforceContact->getProductInstance() === $this) {
                $productInstanceSalesforceContact->setProductInstance(null);
            }
        }

        return $this;
    }

    public function getPoNumber(): ?string
    {
        return $this->poNumber;
    }

    public function setPoNumber(?string $poNumber): self
    {
        $this->poNumber = $poNumber;

        return $this;
    }

    public function getInvoiceContact(): ?string
    {
        return $this->invoiceContact;
    }

    public function setInvoiceContact(?string $invoiceContact): self
    {
        $this->invoiceContact = $invoiceContact;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setProductInstance($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getProductInstance() === $this) {
                $contact->setProductInstance(null);
            }
        }

        return $this;
    }
}
