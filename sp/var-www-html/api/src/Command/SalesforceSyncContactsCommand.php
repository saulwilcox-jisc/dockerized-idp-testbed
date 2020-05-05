<?php

namespace App\Command;

use App\Jisc\SalesforceBundle\Service\SalesforceService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SalesforceSyncContactsCommand extends Command
{
    protected static $defaultName = 'app:salesforce:sync-contacts';
    /**
     * @var SalesforceService
     */
    private $salesforceService;

    public function __construct(SalesforceService $salesforceService)
    {
        parent::__construct();
        $this->salesforceService = $salesforceService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $metaData = $this->salesforceService->syncContacts();


        $io->success('You have successfully synced ' . $metaData . ' accounts with Salesforce');

        return 0;
    }
}
