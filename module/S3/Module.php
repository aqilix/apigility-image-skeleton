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
