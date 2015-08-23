<?php
/**
 * Image Module
 *
 * @link
 * @copyright Copyright (c) 2015
 */
namespace AqilixAPI\Image;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Uri\UriFactory;
use Zend\Mvc\MvcEvent;
use AqilixAPI\Image\Service\ImageSharedListener;

/**
 * Module Class for image
 *
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
class Module implements ApigilityProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        UriFactory::registerScheme('chrome-extension', 'Zend\Uri\Uri'); // add chrome-extension for API Client
        $serviceManager = $e->getApplication()->getServiceManager();
        $eventManager   = $e->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // attach image shared event listener
        $sharedEventManager->attachAggregate($serviceManager->get('AqilixAPI\\Image\\SharedEventListener'));
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
}
