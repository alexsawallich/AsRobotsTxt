<?php
//
// NAMESPACE + USE
//


namespace AsRobotsTxt\Options;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


//
// CLASS
//


/**
 * Factory to instantiate \AsRobotsTxt\Options\Options
 */
class OptionsFactory implements FactoryInterface
{
    //
    // METHODS
    //
    
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $options = isset($config['asrobotstxt']) ? $config['asrobotstxt'] : array();
        return new \AsRobotsTxt\Options\Options($options);
    }
}