<?php
/**
 * Image Module
 *
 * @link      
 * @copyright Copyright (c) 2015
 */

namespace Image\Service;

use Zend\EventManager\EventInterface;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\SharedListenerAggregateInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Image\Event as ImageEvent;

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
        $this->listeners[] = $events->attach('*', ImageEvent::POST_SUCCESS, [$this, 'postSuccess'], 1);
        $this->listeners[] = $events->attach('*', ImageEvent::PUT_SUCCESS, [$this, 'putSuccess'], 1);
        $this->listeners[] = $events->attach('*', ImageEvent::DEL_SUCCESS, [$this, 'delSuccess'], 1);
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
     * Listen to the "api.post.success" event
     *
     * @param EventInterface $event
     */
    public function postSuccess(EventInterface $event)
    {
    }

    /**
     * Listen to the "api.put.success" event
     *
     * @param EventInterface $event
     */
    public function putSuccess(EventInterface $event)
    {
        var_dump($event);
    }

    /**
     * Listen to the "api.del.success" event
     *
     * @param EventInterface $event
     */
    public function delSuccess(EventInterface $event)
    {
        var_dump($event);
    }
}
