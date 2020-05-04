<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"productInstance"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"productInstance"})
     */
    private $joid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tradingName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vatCsgMember;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $externalId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accountType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SalesforceContact", mappedBy="account")
     */
    private $salesforceContacts;

    public function __construct()
    {
        $this->salesforceContacts = new ArrayCollection();
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

    public function getJoid(): ?string
    {
        return $this->joid;
    }

    public function setJoid(string $joid): self
    {
        $this->joid = $joid;

        return $this;
    }

    public function getTradingName(): ?string
    {
        return $this->tradingName;
    }

    public function setTradingName(?string $tradingName): self
    {
        $this->tradingName = $tradingName;

        return $this;
    }

    public function getVatCsgMember(): ?bool
    {
        return $this->vatCsgMember;
    }

    public function setVatCsgMember(bool $vatCsgMember): self
    {
        $this->vatCsgMember = $vatCsgMember;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getAccountType(): ?string
    {
        return $this->accountType;
    }

    public function setAccountType(?string $accountType): self
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * @return Collection|SalesforceContact[]
     */
    public function getSalesforceContacts(): Collection
    {
        return $this->salesforceContacts;
    }

    public function addSalesforceContact(SalesforceContact $salesforceContact): self
    {
        if (!$this->salesforceContacts->contains($salesforceContact)) {
            $this->salesforceContacts[] = $salesforceContact;
            $salesforceContact->setAccount($this);
        }

        return $this;
    }

    public function removeSalesforceContact(SalesforceContact $salesforceContact): self
    {
        if ($this->salesforceContacts->contains($salesforceContact)) {
            $this->salesforceContacts->removeElement($salesforceContact);
            // set the owning side to null (unless already changed)
            if ($salesforceContact->getAccount() === $this) {
                $salesforceContact->setAccount(null);
            }
        }

        return $this;
    }
}
