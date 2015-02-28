<?php
//
// NAMESPACE + USE
//


namespace AsRobotsTxt;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;


//
// CLASS
//


/**
 * Class to tell the application about this module.
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    //
    // METHODS
    //
    
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\ConfigProviderInterface::getConfig()
     */
    public function getConfig()
    {
        return include(dirname(__FILE__) . '/config/module.config.php');
    }
}