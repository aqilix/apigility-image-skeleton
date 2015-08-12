<?php

namespace Image\Mapper\Adapter;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Image\Mapper\ImageInterface as ImageMapperInterface;

/**
 * Image Mapper with Doctrine support
 * 
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
class Doctrine implements ImageMapperInterface, ServiceLocatorAwareInterface
{
    protected $sm;
    
    protected $em;
    
    /**
     * Create Image 
     * 
     * @param array $data
     */
    public function create($data)
    {
    }

    /**
     * Fetch Image by Id
     * 
     * @param int $id
     */
    public function fetchOne($id)
    {
        $er = $this->getEntityManager()->getRepository('Image\Entity\Image');
        return $er->findOneBy(array('id' => $id));
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
     * @param int   $id
     * @param array $data
     */
    public function update($id, $data)
    {
    }
    
    /**
     * Delete Image
     * 
     * @param int $id
     */
    public function delete($id)
    {
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
}
