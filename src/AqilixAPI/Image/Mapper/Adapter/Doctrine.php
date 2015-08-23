<?php

namespace AqilixAPI\Image\Mapper\Adapter;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use AqilixAPI\Image\Mapper\ImageInterface as ImageMapperInterface;
use AqilixAPI\Image\Entity\Image as ImageEntity;
use AqilixAPI\Image\Entity\ImageInterface as ImageEntityInterface;

/**
 * Image Mapper with Doctrine support
 *
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
class Doctrine implements ImageMapperInterface, ServiceLocatorAwareInterface
{
    protected $sm;
    
    protected $em;
    
    protected $hydrator;
    
    /**
     * Create Image
     *
     * @param ImageEntityInterface $entity
     */
    public function create(ImageEntityInterface $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        
        return $entity;
    }

    /**
     * Fetch Image by Id
     *
     * @param int $id
     */
    public function fetchOne($id)
    {
        return $this->getEntityRepository()->findOneBy(array('id' => $id));
    }

    /**
     * Fetch Images
     *
     * @param int $id
     * @param int $page
     */
    public function fetchAll($id, $page)
    {
    }
    
    /**
     * Update Image
     *
     * @param array $data
     */
    public function update(ImageEntityInterface $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        
        return $entity;
    }
    
    /**
     * Delete Image
     *
     * @param ImageEntityInterface $entity
     */
    public function delete(ImageEntityInterface $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
    
    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }
    
    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->sm;
    }
    
    /**
     * Set EntityManager
     *
     * @param EntityManagerInterface $serviceLocator
     */
    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * Get EntityManager
     *
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        if ($this->em === null) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\\ORM\\EntityManager'));
        }
        
        return $this->em;
    }
    
    /**
     * Set Hydrator
     *
     * @param HydratorInterface $hydrator
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }
    
    /**
     * Get Hydrator
     *
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if ($this->hydrator === null) {
            $hydratorManager = $this->getServiceLocator()->get('HydratorManager');
            $hydrator = $hydratorManager->get('DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject');
            $this->setHydrator($hydrator);
        }
    
        return $this->hydrator;
    }
    
    /**
     * Get Entity Repository
     */
    protected function getEntityRepository()
    {
        return $this->getEntityManager()->getRepository('AqilixAPI\Image\Entity\Image');
    }
}
