<?php

namespace ContainerNoTkKOW;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDataCopyControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\DataCopyController' shared autowired service.
     *
     * @return \App\Controller\DataCopyController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/DataCopyController.php';

        $container->services['App\\Controller\\DataCopyController'] = $instance = new \App\Controller\DataCopyController();

        $instance->setContainer(($container->privates['.service_locator.jIxfAsi'] ?? $container->load('get_ServiceLocator_JIxfAsiService'))->withContext('App\\Controller\\DataCopyController', $container));

        return $instance;
    }
}
