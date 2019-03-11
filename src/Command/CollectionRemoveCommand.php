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
class CollectionRemoveCommand extends AbstractDatabaseCommand
{
    /**
     * @param ArangoDBInterface $databaseClient
     */
    public function __construct(ArangoDBInterface $databaseClient)
    {
        parent::__construct('collections:remove', $databaseClient);

        $this->addArgument('collection', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->getDatabaseClient()->collections()->removeCollection($input->getArgument('collection'));
            $io->success('Removed collection.');
        } catch (\Throwable $e) {
            $io->error($e->getMessage());
        }
    }
}
