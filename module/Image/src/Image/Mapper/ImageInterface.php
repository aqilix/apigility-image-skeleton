<?php

namespace Image\Mapper;

use Image\Entity\ImageInterface as ImageEntityInterface;

/**
 * Interface Image Mapper
 * 
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
interface ImageInterface
{
    public function create(ImageEntityInterface $entity);
    
    public function fetchOne($id);
    
    public function fetchAll($id, $page);
    
    public function update(ImageEntityInterface $entity);
    
    public function delete(ImageEntityInterface $entity);
}
