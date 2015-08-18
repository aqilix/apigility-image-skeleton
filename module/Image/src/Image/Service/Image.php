<?php
namespace Image\Service;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Image\Entity\ImageInterface as ImageEntityInterface;
use Image\Entity\Image as ImageEntity;

class Image implements ServiceLocatorAwareInterface
{
    protected $identifier;
    
    protected $entity;
    
    protected $inputFilter;

    use ServiceLocatorAwareTrait;

    /**
     * Set Identifier
     * 
     * @param int $entity
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
    
    /**
     * Get Identifier 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
    
    /**
     * Set Entity
     * 
     * @param ImageEntityInterface $entity
     */
    public function setEntity(ImageEntityInterface $entity)
    {
        $this->entity = $entity;
    }
    
    /**
     * Get Entity
     * 
     * @return $entity
     */
    public function getEntity()
    {
        $mapper = $this->getServiceLocator()->get('Image\\Mapper\\Image');
        if ($this->entity === null && $this->getIdentifier() === null) {
            $inputFilter = $this->getInputFilter();
            $data = array(
                        'description' => $inputFilter->getValue('description'),
                        'path'  => $inputFilter->getValue('image')['tmp_name'],
                        'ctime' => new \DateTime()
                    );
            $this->entity = $mapper->getHydrator()->hydrate($data, new ImageEntity());
        } else {
            $this->entity = $mapper->fetchOne($this->getIdentifier());
        }
        
        return $this->entity;
    }
    
    /**
     * Set InputFilter
     * 
     * @param InputFilterInterface $inputFilter
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }
    
    /**
     * Get InputFilter
     * 
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
