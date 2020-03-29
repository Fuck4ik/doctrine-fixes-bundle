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
        if (method_exists(TreeBuilder::class, 'root')) {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('ruvents_doctrine_fixes');
        } else {
            $treeBuilder = new TreeBuilder('ruvents_doctrine_fixes');
            $rootNode = $treeBuilder->getRootNode();
        }

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
