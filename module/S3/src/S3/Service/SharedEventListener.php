<?php
/**
 * S3 Module
 *
 * @link      
 * @copyright Copyright (c) 2015
 */

namespace S3\Service;

use Zend\EventManager\EventInterface;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\SharedListenerAggregateInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Image\Event as ImageEvent;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

/**
 * Log Event Listener

 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 *
 * @SuppressWarnings(PHPMD)
 */
class SharedEventListener implements SharedListenerAggregateInterface, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    /**
     * List of listeners
     * 
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = [];
    
    /**
     * Attach listeners to an event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function attachShared(SharedEventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('*', ImageEvent::POST_UPLOAD, [$this, 'putObject'], 1);
    }
    
    /**
     * Detach listeners from an event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function detachShared(SharedEventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detachShared($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
    /**
     * Put Object to S3
     * 
     * @param EventInterface $event
     */
    public function putObject(EventInterface $event)
    {
        $params = $event->getParams();
        $config = $this->getServiceLocator()->get('Config');
        $imageFileName = basename(basename($params->getPath()));
        $thumbFileName = basename(basename($params->getThumbPath()));
        $s3 = S3Client::factory(array(
                    'credentials' => array(
                        'key' => $config['aws']['credentials']['key'],
                        'secret'  => $config['aws']['credentials']['secret'],
                     ),
                    'version' => $config['aws']['version'],
                    'region'  => $config['aws']['region'],
                    'http' => array(
                        'verify' => false
                    )
                ));
            
        // uploading image to S3
        try {
            $s3->putObject(array(
                'Bucket' => $config['s3']['bucket']['name'],
                'Key'    => $config['s3']['bucket']['key_prefix'] . '/' . $imageFileName,
                'Body'   => fopen($params->getPath(), 'r'),
                'ACL'    => $config['s3']['bucket']['acl'],
            ));
        } catch (S3Exception $e) {
        }
        
        // uploading thumbnail to S3
        try {
            $s3->putObject(array(
                'Bucket' => $config['s3']['bucket']['name'],
                'Key'    => $config['s3']['bucket']['key_prefix'] . '/'
                . $config['s3']['bucket']['thumb_prefix'] . '/' . $imageFileName,
                'Body'   => fopen($params->getThumbPath(), 'r'),
                'ACL'    => $config['s3']['bucket']['acl'],
            ));
        } catch (S3Exception $e) {
        }
    }
}
