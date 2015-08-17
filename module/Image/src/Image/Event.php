<?php
/**
 * Image Module
 *
 * @link      
 * @copyright Copyright (c) 2015
 */

namespace Image;

/**
 * Contain some events for image API
 *
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
class Event
{
    /**
     * post success 
     */
    const POST_SUCCESS = 'api.image.post.success';
    
    /**
     * post failed
     */
    const POST_FAILED  = 'api.image.post.failed';
    
    /**
     * put success
     */
    const PUT_SUCCESS  = 'api.image.put.success';
    
    /**
     * put failed
     */
    const PUT_FAILED   = 'api.image.put.failed';
    
    /**
     * patch success
     */
    const PATCH_SUCCESS = 'api.image.patch.success';
    
    /**
     * patch failed
     */
    const PATCH_FAILED  = 'api.image.patch.failed';
    
    /**
     * del success
     */
    const DEL_SUCCESS  = 'api.image.del.success';
    
    /**
     * del failed
     */
    const DEL_FAILED   = 'api.image.del.failed';
}
