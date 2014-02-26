<?php
namespace MarijnKoesen\DebugBundle\DependencyInjection;

use MarijnKoesen\DebugBundle\Library\QueryLogger;
use MarijnKoesen\DebugBundle\Library\RequestId;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MarijnKoesenDebugExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('marijn_koesen_debug.query_log.enabled', $config['query_log']['enabled']);
        $container->setParameter('marijn_koesen_debug.query_log.path', $config['query_log']['path']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/'));
        $loader->load('services.xml');
    }
}
