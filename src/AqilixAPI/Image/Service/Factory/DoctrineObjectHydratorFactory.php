<?php
namespace AqilixAPI\Image\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use AqilixAPI\Image\Stdlib\Hydrator\Strategy\ISODateTimeStrategy;
use AqilixAPI\Image\Stdlib\Hydrator\Strategy\AssetManagerResolverStrategy;

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
        $amResolverStrategy = $parentServiceLocator
                                ->get('AqilixAPI\\Image\\Stdlib\\Hydrator\\Strategy\\AssetManagerResolverStrategy');
        $hydrator = new DoctrineObject($entityManager);
        $hydrator->addStrategy('ctime', new ISODateTimeStrategy);
        $hydrator->addStrategy('utime', new ISODateTimeStrategy);
        $hydrator->addStrategy('path', $amResolverStrategy);
        $hydrator->addStrategy('thumbPath', $amResolverStrategy);
        return $hydrator;
    }
}
