<?php
namespace MarijnKoesen\DebugBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;


class DoctrineLoggerInjectPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->getParameter('marijn_koesen_debug.query_log.enabled')) {
            $definition = $container->getDefinition('doctrine.dbal.logger.chain');
            $definition->addMethodCall('addLogger', array(new Reference('marijnkoesen.debugbundle.querylogger')));
        }
    }
}
