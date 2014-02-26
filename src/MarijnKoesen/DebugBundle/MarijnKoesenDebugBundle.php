<?php

namespace MarijnKoesen\DebugBundle;

use MarijnKoesen\DebugBundle\DependencyInjection\Compiler\DoctrineLoggerInjectPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MarijnKoesenDebugBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineLoggerInjectPass());
    }
}