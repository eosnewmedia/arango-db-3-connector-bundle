<?php
declare(strict_types=1);

namespace Eos\Bundle\ArangoDBConnector\DependencyInjection;

use Eos\ArangoDBConnector\ArangoDB;
use Eos\ArangoDBConnector\ArangoDBInterface;
use Eos\ArangoDBConnector\Collection\CollectionHandler;
use Eos\ArangoDBConnector\Collection\CollectionHandlerInterface;
use Eos\ArangoDBConnector\Connection\ConnectionFactory;
use Eos\ArangoDBConnector\Connection\ConnectionFactoryInterface;
use Eos\ArangoDBConnector\Database\DatabaseHandler;
use Eos\ArangoDBConnector\Database\DatabaseHandlerInterface;
use Eos\ArangoDBConnector\Statement\StatementFactory;
use Eos\ArangoDBConnector\Statement\StatementFactoryInterface;
use Eos\Bundle\ArangoDBConnector\Command\CollectionCreateCommand;
use Eos\Bundle\ArangoDBConnector\Command\CollectionRemoveCommand;
use Eos\Bundle\ArangoDBConnector\Command\DatabaseCreateCommand;
use Eos\Bundle\ArangoDBConnector\Command\DatabaseRemoveCommand;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class EosArangoDBConnectorExtension extends ConfigurableExtension
{
    /**
     * @param array $mergedConfig
     * @param ContainerBuilder $container
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $container->autowire(ConnectionFactory::class)
            ->addArgument((array)$mergedConfig['servers'])
            ->addArgument((string)$mergedConfig['database'])
            ->addArgument((string)$mergedConfig['user'])
            ->addArgument((string)$mergedConfig['password'])
            ->setPublic(false);

        $container->setAlias(ConnectionFactoryInterface::class, ConnectionFactory::class)
            ->setPublic(false);


        $container->autowire(DatabaseHandler::class)
            ->setPublic(false);

        $container->setAlias(DatabaseHandlerInterface::class, DatabaseHandler::class)
            ->setPublic(false);


        $container->autowire(CollectionHandler::class)
            ->setPublic(false);

        $container->setAlias(CollectionHandlerInterface::class, CollectionHandler::class)
            ->setPublic(false);


        $container->autowire(StatementFactory::class)
            ->setPublic(false);

        $container->setAlias(StatementFactoryInterface::class, StatementFactory::class)
            ->setPublic(false);


        $container->autowire(ArangoDB::class)
            ->setPublic(false);

        $container->setAlias(ArangoDBInterface::class, ArangoDB::class)
            ->setPublic(false);


        $container->autowire(DatabaseCreateCommand::class)
            ->addTag('console.command')
            ->setPublic(true);

        $container->autowire(DatabaseRemoveCommand::class)
            ->addTag('console.command')
            ->setPublic(true);

        $container->autowire(CollectionCreateCommand::class)
            ->addArgument($mergedConfig['collections'])
            ->addTag('console.command')
            ->setPublic(true);

        $container->autowire(CollectionRemoveCommand::class)
            ->addTag('console.command')
            ->setPublic(true);
    }
}
