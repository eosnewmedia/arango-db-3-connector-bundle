<?php
declare(strict_types=1);

namespace Eos\Bundle\ArangoDBConnector\Command;

use Eos\ArangoDBConnector\ArangoDBInterface;
use Symfony\Component\Console\Command\Command;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
abstract class AbstractDatabaseCommand extends Command
{
    /**
     * @var ArangoDBInterface
     */
    private $databaseClient;

    /**
     * @param string $name
     * @param ArangoDBInterface $databaseClient
     */
    public function __construct(string $name, ArangoDBInterface $databaseClient)
    {
        parent::__construct('eos:arango-db:' . $name);
        $this->databaseClient = $databaseClient;
    }

    /**
     * @return ArangoDBInterface
     */
    protected function getDatabaseClient(): ArangoDBInterface
    {
        return $this->databaseClient;
    }
}
