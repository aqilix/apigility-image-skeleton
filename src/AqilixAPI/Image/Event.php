<?php
/**
 * Image Module
 *
 * @link
 * @copyright Copyright (c) 2015
 */

namespace AqilixAPI\Image;

/**
 * Contain some events for image API
 *
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 */
class Event
{
    /**
     * post upload
     */
    const POST_UPLOAD  = 'aqilixapi.image.post.upload';
    
    
    /**
     * post success
     */
    const POST_SUCCESS = 'aqilixapi.image.post.success';
    
    /**
     * post failed
     */
    const POST_FAILED  = 'aqilixapi.image.post.failed';
    
    /**
     * put success
     */
    const PUT_SUCCESS  = 'aqilixapi.image.put.success';
    
    /**
     * put failed
     */
    const PUT_FAILED   = 'aqilixapi.image.put.failed';
    
    /**
     * patch success
     */
    const PATCH_SUCCESS = 'aqilixapi.image.patch.success';
    
    /**
     * patch failed
     */
    const PATCH_FAILED  = 'aqilixapi.image.patch.failed';
    
    /**
     * del success
     */
    const DEL_SUCCESS  = 'aqilixapi.image.del.success';
    
    /**
     * del failed
     */
    const DEL_FAILED   = 'aqilixapi.image.del.failed';
}
