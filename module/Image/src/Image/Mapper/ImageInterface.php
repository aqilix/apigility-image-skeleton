<?php

namespace Image\Mapper;

/**
 * Interface Image Mapper
 * 
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
interface ImageInterface
{
    public function create($data);
    
    public function fetchOne($id);
    
    public function fetchAll($id, $page);
    
    public function update($id, $data);
    
    public function delete($id);
}
