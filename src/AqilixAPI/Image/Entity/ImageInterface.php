<?php

namespace AqilixAPI\Image\Entity;

/**
 * Interface Image Entity
 *
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
interface ImageInterface
{
    public function getId();
    
    public function setId($id);
    
    public function getPath();
    
    public function setPath($path);
    
    public function getDescription();
    
    public function setDescription($description);
    
    public function getCtime();
    
    public function setCtime(\DateTime $dateTime);
    
    public function getUtime();
    
    public function setUtime(\DateTime $dateTime);
}
