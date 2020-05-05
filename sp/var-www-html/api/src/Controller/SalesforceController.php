<?php

namespace App\Controller;

use App\Jisc\SalesforceBundle\Service\SalesforceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SalesforceController extends AbstractController
{
    /**
     * @Route("/salesforce", name="salesforce")
     * @param SalesforceService $salesforceService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SalesforceService $salesforceService)
    {
        $accounts = $salesforceService->getContacts();
        return $this->render('salesforce/index.html.twig', [
            'accounts' => print_r(($accounts), true),
        ]);
    }
}
