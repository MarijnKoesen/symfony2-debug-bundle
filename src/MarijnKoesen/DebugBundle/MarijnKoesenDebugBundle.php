<?php

namespace MarijnKoesen\DebugBundle;

use MarijnKoesen\DebugBundle\DependencyInjection\Compiler\DoctrineLoggerInjectPass;
use MarijnKoesen\DebugBundle\Library\RequestId;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MarijnKoesenDebugBundle extends Bundle
{
    public function boot()
    {
        // TODO do this with a service to make it user overwritable
        RequestId::registerId();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineLoggerInjectPass());
    }
}
