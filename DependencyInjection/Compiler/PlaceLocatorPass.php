<?php

namespace MSB\LocatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class PlaceLocatorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('place_locator') && !$container->hasAlias('place_locator')) {
            return;
        }

        $definition = $container->findDefinition('place_locator');

        foreach ($container->findTaggedServiceIds('place_locator') as $id => $tags) {
            $definition->addMethodCall('addLocator', [new Reference($id)]);
        }
    }
}
