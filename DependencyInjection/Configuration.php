<?php

namespace Ruvents\DoctrineFixesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ruvents_doctrine_fixes');

        /** @noinspection PhpUndefinedMethodInspection */
        $rootNode
            ->useAttributeAsKey('connection')
            ->prototype('array')
                ->children()
                    ->arrayNode('schema_namespace_fix')
                        ->canBeEnabled()
                        ->children()
                            ->scalarNode('namespace')->defaultNull()->end()
                        ->end()
                    ->end()
                    ->arrayNode('default_value_fix')
                        ->canBeEnabled()
                        ->children()
                            ->arrayNode('aliases')
                                ->arrayPrototype()
                                    ->children()
                                        ->scalarNode('value1')->end()
                                        ->scalarNode('value2')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
