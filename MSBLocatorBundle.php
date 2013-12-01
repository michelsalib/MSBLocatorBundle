<?php

namespace MSB\LocatorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MSB\LocatorBundle\DependencyInjection\Compiler\PlaceLocatorPass;

class MSBLocatorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
		
		$container->addCompilerPass(new PlaceLocatorPass());
	}
}
