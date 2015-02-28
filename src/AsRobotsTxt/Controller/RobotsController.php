<?php
//
// NAMESPACE + USE
//


namespace AsRobotsTxt\Controller;
use Zend\Mvc\Controller\AbstractActionController;


//
// CLASS
//


/**
 * Controller for generating and outputting the robots.txt.
 */
class RobotsController extends AbstractActionController
{
    //
    // PROPERTIES
    //
    
    
    /**
     * Instance of the module's options.
     * 
     * @var \AsRobotsTxt\Options\Options
     */
    protected $options;
    
    
    //
    // METHODS
    //
    
    
    /**
     * Construct. Injects necessary resources into the controller.
     * 
     * @param \AsRobotsTxt\Options\Options $options
     */
    public function __construct(\AsRobotsTxt\Options\Options $options)
    {
        $this->setOptions($options);
    }
    
    /**
     * renders the robots.txt-Output.
     */
    public function robotsTxtAction()
    {
        $output = $this->getOutput();
        
        // Set headers and return response
        $response = $this->getResponse();
        $response->setContent($output)
                 ->getHeaders()
                 ->addHeaderLine('Content-Type', 'text/plain; charset=utf-8');
        return $response;
    }
    
    /**
     * Gets the modules options.
     * 
     * @return \AsRobotsTxt\Options\Options
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * Returns the robots.txt-contents, ready for output.
     * 
     * Depending on the configured options the output is read from cache.
     * 
     * @return string
     */
    protected function getOutput()
    {
        $options = $this->getOptions();
        
        // Check if cache is enabled
        if(true == $options->getEnableCache())
        {
            $cacheDir = $options->getCacheDir();
            $hash = md5(serialize($options));
            $cacheFile = rtrim($cacheDir, '/') . '/' . $hash . '.cache';
            
            // Check if cache-file exists
            if(false === file_exists($cacheFile))
            {
                // Delete cache-files of other configurations
                $files = glob(rtrim($cacheDir, '/') . '/*');
                foreach($files AS $file)
                {
                	@unlink($file);
                }
                
                // Write new cache-file
                $content = $this->generateContent();
                file_put_contents($cacheFile, $content);
                return $content;
            }
            else
            {
                // Return contents of cache-file
                return file_get_contents($cacheFile);
            }
        }
        
        return $this->generateContent();
    }
    
    /**
     * Generates the string, which will be output/written into the cache-file.
     * 
     * @return string
     */
    protected function generateContent()
    {
        $options = $this->getOptions();
        $content = '';
        
        // Check for optional sitemap-path
        if(NULL != $options->getSitemapXmlPath())
        {
            $content .= 'Sitemap: ' . $options->getSitemapXmlPath() . str_repeat(PHP_EOL, 2);
        }
        
        // Custom lines
        if(count($options->getCustomLines()) > 0)
        {
        	$lines = implode(PHP_EOL, $options->getCustomLines());
        	$content .= $lines . str_repeat(PHP_EOL, 2);
        }
        
        // Disable all? Could be useful for non-production-mode...
        if(true == $options->getDisallowAll())
        {
            $content .= 'User-Agent: *' . PHP_EOL . 'Disallow: /';
            return $content;
        }
        
        // Rules
        if(count($options->getRules()) > 0)
        {
            foreach($options->getRules() AS $rule)
            {
                foreach($rule['user_agent'] AS $userAgent)
                {
                    $content .= 'User-Agent: ' . $userAgent . PHP_EOL;
                }
                
                foreach($rule['disallow'] AS $disallow)
                {
                	$content .= 'Disallow: ' . $disallow . PHP_EOL;
                }
                
                $content .= PHP_EOL;
            }
        }
        
        return $content;
    }
    
    /**
     * Injects the module's options into the object.
     * 
     * @param \AsRobotsTxt\Options\Options $options
     * @return \AsRobotsTxt\Controller\RobotsController
     */
    public function setOptions(\AsRobotsTxt\Options\Options $options)
    {
        $this->options = $options;
        return $this;
    }
}