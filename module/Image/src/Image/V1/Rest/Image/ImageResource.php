<?php
/**
 * Image Module
 *
 * @link
 * @copyright Copyright (c) 2015
 */

namespace Image\V1\Rest\Image;

use ZF\ApiProblem\ApiProblem;
use Image\V1\Rest\AbstractResourceListener;
use Image\Event as ImageEvent;

/**
 * Rest Image Resource

 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 *
 * @SuppressWarnings(PHPMD)
 */
class ImageResource extends AbstractResourceListener
{
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $inputFilter = $this->getInputFilter();
        $data = array(
            'description' => $inputFilter->getValue('description'),
            'path'  => $inputFilter->getValue('image')['tmp_name'],
            'ctime' => new \DateTime()
        );
        
        try {
            $image = $this->getMapper()->create($data);
            $this->getEventManager()->trigger(ImageEvent::POST_SUCCESS, null, $image);
            return $image;
        } catch (\Exception $e) {
            $this->getEventManager()->trigger(ImageEvent::POST_DELETE, null, $data);
            return new ApiProblem(500, 'Uploading image error');
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $this->getEventManager()->trigger('image_test', null, array('id' => 1, 'name' => 'asdf'));
        return $this->getMapper()->fetchOne($id);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        $data = $this->getInputFilter();
        try {
            $image = $this->getMapper()->update($id, $data);
            $this->getEventManager()->trigger(ImageEvent::PATCH_SUCCESS, null, $image);
            return $image;
        } catch (\Exception $e) {
            $this->getEventManager()->trigger(ImageEvent::PATCH_FAILED, null, $data);
            return new ApiProblem(500, 'Uploading image error');
        }
    }

    /**
     * Get images configuration
     */
    protected function getImagesConfig()
    {
        return $this->getServiceLocator()->get('Config')['images'];
    }
    
    protected function getMapper()
    {
        return $this->getServiceLocator()->get('Image\\Mapper\\Image');
    }
}
