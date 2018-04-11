<?php

namespace A5sys\PydioBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('breeder');

        $rootNode
            ->children()
                ->scalarNode('login')->isRequired()->end()
                ->scalarNode('password')->isRequired()->end()
                ->scalarNode('base_api_url')->isRequired()->end()
                ->scalarNode('api_url')->defaultValue('/pydio/api/v2')->end()
            ->end();

        return $treeBuilder;
    }
}
