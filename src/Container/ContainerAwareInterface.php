<?php

declare(strict_types=1);

namespace DoctrineDataFixtureModule\Container;

use Interop\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface
 * @package DoctrineDataFixtureModule
 */
interface ContainerAwareInterface
{
    /**
     * @param ContainerInterface $container
     * @return null
     */
    public function setContainer(ContainerInterface $container);
}