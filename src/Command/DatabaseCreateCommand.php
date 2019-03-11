<?php
declare(strict_types=1);

namespace Eos\Bundle\ArangoDBConnector\Command;

use Eos\ArangoDBConnector\ArangoDBInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class DatabaseCreateCommand extends AbstractDatabaseCommand
{
    /**
     * @param ArangoDBInterface $databaseClient
     */
    public function __construct(ArangoDBInterface $databaseClient)
    {
        parent::__construct('database:create', $databaseClient);

        $this->addArgument('username', InputArgument::OPTIONAL, 'The database admin username.');
        $this->addArgument('password', InputArgument::OPTIONAL, 'The database admin password.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        try {
            $this->getDatabaseClient()->database()->createDatabase(
                $input->getArgument('username'),
                $input->getArgument('password')
            );

            (new SymfonyStyle($input, $output))->success('Database created!');
        } catch (\Throwable $e) {
            (new SymfonyStyle($input, $output))->error($e->getMessage());
        }
    }
}
