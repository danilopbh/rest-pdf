<?php

namespace ContainerWxtvks2;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getContribuinteSiatuRepositoryService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Repository\ContribuinteSiatuRepository' shared autowired service.
     *
     * @return \App\Repository\ContribuinteSiatuRepository
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/src/Persistence/ObjectRepository.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/collections/src/Selectable.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/src/EntityRepository.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/src/Repository/ServiceEntityRepositoryInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/src/Repository/ServiceEntityRepositoryProxy.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/src/Repository/ServiceEntityRepository.php';
        include_once \dirname(__DIR__, 4).'/src/Repository/ContribuinteSiatuRepository.php';

        return $container->privates['App\\Repository\\ContribuinteSiatuRepository'] = new \App\Repository\ContribuinteSiatuRepository(($container->services['doctrine'] ?? $container->getDoctrineService()));
    }
}
