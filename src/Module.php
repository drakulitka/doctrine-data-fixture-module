<?php

declare(strict_types=1);

namespace DoctrineDataFixtureModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Loader\StandardAutoloader;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManager;
use DoctrineDataFixtureModule\Command\FixturesLoadCommand;

/**
 * Class Module
 * @package DoctrineDataFixtureModule
 */
class Module implements ConfigProviderInterface, AutoloaderProviderInterface
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ],
            ],
        );
    }

    /**
     * @param ModuleManager $moduleManager
     */
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager()->getSharedManager();
        $events->attach('doctrine', 'loadCli.post', [$this, 'addFixturesLoadCommand']);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/doctrine.config.php';
    }

    /**
     * @param EventInterface $event
     */
    public function addFixturesLoadCommand(EventInterface $event)
    {
        /* @var \Symfony\Component\Console\Application $application */
        $application = $event->getTarget();

        /* @var \Interop\Container\ContainerInterface $container */
        $container = $event->getParam('ServiceManager');
        $fixturesLoadCommand = new FixturesLoadCommand($container);
        $application->add($fixturesLoadCommand);
    }
}