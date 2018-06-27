<?php

declare(strict_types=1);

namespace DoctrineDataFixtureModule\Container;

use Interop\Container\ContainerInterface;

/**
 * Class ContainerAwareTrait
 * @package DoctrineDataFixtureModule
 */
trait ContainerAwareTrait
{
    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}