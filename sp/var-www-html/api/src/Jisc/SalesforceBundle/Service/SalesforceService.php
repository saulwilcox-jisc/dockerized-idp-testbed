<?php

namespace App\Jisc\SalesforceBundle\Service;

use App\Entity\Account;
use App\Entity\SalesforceContact;
use App\Entity\SalesforceRole;
use App\Jisc\SalesforceBundle\Client\SalesforceClient;
use Doctrine\ORM\EntityManagerInterface;

class SalesforceService
{
    /**
     * @var SalesforceClient
     */
    private $salesforceClient;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(SalesforceClient $salesforceClient, EntityManagerInterface $entityManager)
    {
        $this->salesforceClient = $salesforceClient;
        $this->entityManager = $entityManager;
    }

    public function getAccounts()
    {
        return $this->salesforceClient->query(
            'SELECT Id,Name,Trading_name__c,Jisc_ID__c,Account_type__c,Jisc_VAT_CSG_Membership__c from Account'
        );
    }

    public function getContacts()
    {
        return $this->salesforceClient->query(
            "SELECT Id,Contact.Id,Contact.JOID__c,Contact.email,Contact.Name,Contact.Phone,Role FROM AccountContactRole WHERE Role LIKE 'Collections%' OR Role LIKE 'JUSP%' OR Role LIKE 'KB%'"
        );
    }

    private function getStack($entity, $key)
    {
        $stack = [];
        $entities = $this->entityManager->getRepository($entity)->findAll();
        $keyMethod = 'get' . ucfirst($key);
        foreach ($entities as $entity) {
            $stack[$entity->$keyMethod()] = $entity;
        }

        return $stack;
    }

    public function syncContacts()
    {
        $count = 0;
        $accountsStack = $this->getStack(Account::class, 'Joid');
        $contactsStack = $this->getStack(SalesforceContact::class, 'externalId');
        $contactsJson = $this->getContacts();
        $newStack = [];
        foreach ($contactsJson as $contact) {
            $newStack[$contact->Contact->Id]['contact'] = $contact->Contact;
            $newStack[$contact->Contact->Id]['roles'][] = $contact->Role;
        }
        foreach ($contactsStack as $contact) {
            if (!isset($newStack[$contact->getExternalId()])) {
                $this->entityManager->remove($contact);
            }
        }
        foreach ($newStack as $item) {
            $contact = $item['contact'];
            $roles = $item['roles'];
            if (!isset($contactsStack[$contact->Id])) {
                $contactEntity = new SalesforceContact();
            } else {
                $contactEntity = $contactsStack[$contact->Id];
            }
            $contactEntity
                ->setExternalId($contact->Id)
                ->setName($contact->Name)
                ->setEmail($contact->Email)
                ->setPhone($contact->Phone)
                ->setAccount($accountsStack[$contact->JOID__c]);
            foreach ($roles as $role) {
                $roleEntity = $this->entityManager->getRepository(SalesforceRole::class)->findOneBy(['name' => $role]);
                if (!$roleEntity) {
                    $roleEntity = new SalesforceRole();
                    $roleEntity->setName($role);
                    $this->entityManager->flush();
                }
                $contactEntity->addRole($roleEntity);
            }
            foreach ($contactEntity->getRoles() as $role) {
                if (!in_array($role->getName(), $roles)) {
                    $contactEntity->removeRole($role);
                }
            }

            $this->entityManager->persist($contactEntity);
            $count++;
            if ($count%25) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }
        $this->entityManager->flush();

        return $count;
    }

    public function syncAccount()
    {
        $count = 0;
        $accounts = $this->getAccounts();
        foreach ($accounts as $account) {
            $accountEntity = new Account();
            $accountEntity->setName($account->Name)
                ->setJoid($account->Jisc_ID__c)
                ->setAccountType($account->Account_Type__c)
                ->setExternalId($account->Id)
                ->setVatCsgMember($account->Jisc_VAT_CSG_Membership__c?true:false);
            $this->entityManager->persist($accountEntity);
            $count++;
            if ($count%25) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }
        $this->entityManager->flush();

        return $count;
    }
}