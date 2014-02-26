<?php

namespace MarijnKoesen\DebugBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('marijn_koesen_debug');

        $rootNode
            ->children()
                ->arrayNode('query_log')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('path')
                            ->info("Directory where to store the log files")
                            ->defaultValue("%kernel.logs_dir%/%kernel.environment%.query.log")
                        ->end()
                        ->booleanNode('enabled')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
