<?php
namespace Image\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Image\Stdlib\Hydrator\Strategy\ISODateTimeStrategy;
use S3\Stdlib\Hydrator\Strategy\S3LinkStrategy;

/**
 * Hydrator for Doctrine Entity 
 * 
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
class DoctrineObjectHydratorFactory implements FactoryInterface
{
    /**
     * Create a service for DoctrineObject Hydrator
     * 
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentServiceLocator = $serviceLocator->getServiceLocator();
        $entityManager = $parentServiceLocator->get('Doctrine\\ORM\\EntityManager');
        $hydrator = new DoctrineObject($entityManager);
        $hydrator->addStrategy('ctime', new ISODateTimeStrategy);
        $hydrator->addStrategy('utime', new ISODateTimeStrategy);
        return $hydrator;
    }
}
