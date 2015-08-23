<?php

namespace S3\Stdlib\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use AwsModule\View\Helper\S3Link;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class S3LinkStrategy
 *
 * @package S3\Stdlib\Hydrator\Strategy
 */
class S3LinkStrategy implements ServiceLocatorAwareInterface, StrategyInterface
{
    use ServiceLocatorAwareTrait;
    
    protected $helper;
    
    protected $prefix;
    
    /**
     * Get S3Link Helper
     * 
     * @return the $bucket
     */
    public function getHelper()
    {
        if ($this->helper === null) {
            $viewHelperManager = $this->getServiceLocator()->get('ViewHelperManager');
            $this->helper = $viewHelperManager->get('s3Link');
            $this->helper->setDefaultBucket($this->getServiceLocator()->get('Config')['s3']['bucket']['name']);
        }
        
        return $this->helper;
    }

    /**
     * Set S3Link Helper
     * 
     * @param string $bucket
     */
    public function setHelper(S3Link $helper)
    {
        $this->helper = $helper;
        return $this;
    }

    /**
     * @return the $prefix
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  object $object (optional) The original object for context.
     * @return string|null Returns the value that should be extracted.
     * @throws \RuntimeException If object os not a User
     */
    public function extract($value, $object = null)
    {
        if (is_string($value)) {
            return $this->getHelper()->__invoke($this->getPrefix() . '/' . basename($value));
        }

        return null;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     * @throws \InvalidArgumentException
     */
    public function hydrate($value, array $data = null)
    {
        if (null !== $value) {
            if (!$value instanceof \DateTime) {
                throw new \InvalidArgumentException('Expected DateTime object');
            }
            // change timezone to server timezone
            $timezone = new \DateTimeZone(date_default_timezone_get());
            $value->setTimezone($timezone);
        }

        return $value;
    }
}
