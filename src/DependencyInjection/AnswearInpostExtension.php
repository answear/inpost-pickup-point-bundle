<?php

declare(strict_types=1);

namespace Answear\InpostBundle\DependencyInjection;

use Answear\InpostBundle\ConfigProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AnswearInpostExtension extends Extension implements PrependExtensionInterface
{
    private array $config;

    public function prepend(ContainerBuilder $container): void
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $this->setConfig($container, $configs);
    }

    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yaml');

        $this->setConfig($container, $configs);

        $definition = $container->getDefinition(ConfigProvider::class);
        $definition->setArguments([
            $this->config['baseUrl'],
            $this->config['apiVersion'],
        ]);
    }

    private function setConfig(ContainerBuilder $container, array $configs): void
    {
        if (isset($this->config)) {
            return;
        }

        $configuration = $this->getConfiguration($configs, $container);
        $this->config = $this->processConfiguration($configuration, $configs);
    }
}
