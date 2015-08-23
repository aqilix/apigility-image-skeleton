<?php

namespace S3;

use Zend\Mvc\MvcEvent;
use S3\Service\SharedEventListener;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $eventManager   = $e->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // attach shared event listener
        $shared = new SharedEventListener();
        $sharedEventManager->attachAggregate($serviceManager->get('S3\\SharedEventListener'));
        // add S3Link Strategy to hydrator
        $hydratorManager = $serviceManager->get('HydratorManager');
        $s3config = $serviceManager->get('Config')['s3'];
        $s3fields = $s3config['fields'];
        $imageHydrator  = $hydratorManager->get('Image\\Entity\\Hydrator');
        $s3LinkStrategy = $serviceManager->get('S3\\Stdlib\\Hydrator\\Strategy\\S3LinkStrategy');
        foreach ($s3fields as $field => $config) {
            $s3LinkStrategy = $serviceManager->get('S3\\Stdlib\\Hydrator\\Strategy\\S3LinkStrategy');
            $imageHydrator->addStrategy($field, $s3LinkStrategy->setPrefix($config['key_prefix']));
        }
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
