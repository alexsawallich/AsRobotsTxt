<?php
//
// NAMESPACE + USE
//


namespace AsRobotsTxt\Controller;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


//
// CLASS
//


/**
 * Factory to instantiate \AsRobotsTxt\Controller\RobotsController.
 */
class RobotsControllerFactory implements FactoryInterface
{
    //
    // METHODS
    //
    
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();
        $options = $serviceLocator->get('AsRobotsTxtOptions');
        return new \AsRobotsTxt\Controller\RobotsController($options);
    }
}