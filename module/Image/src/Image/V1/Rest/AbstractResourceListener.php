<?php
/**
 * Image Module
 *
 * @link      
 * @copyright Copyright (c) 2015
 */
namespace Image\V1\Rest;

use ZF\Rest\AbstractResourceListener as ResourceListener;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Rest AbstractResourceListener

 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 *
 * @SuppressWarnings(PHPMD)
 */
class AbstractResourceListener extends ResourceListener implements
    ServiceLocatorAwareInterface,
    EventManagerAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    use EventManagerAwareTrait;
}
