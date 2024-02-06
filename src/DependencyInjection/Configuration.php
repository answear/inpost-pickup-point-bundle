<?php

declare(strict_types=1);

namespace Answear\InpostBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('answear_inpost');

        $treeBuilder->getRootNode()
            ->children()
            ?->scalarNode('baseUrl')->defaultNull()->end()
            ?->end();

        return $treeBuilder;
    }
}
