<?php
//
// NAMESPACE + USE
//


namespace AsRobotsTxt\Options;
use Zend\Stdlib\AbstractOptions;


//
// CLASS
//


/**
 * Module's options.
 * 
 * The docs for each property can be found in config/asrobotstxt.config.php.dist.
 */
class Options extends AbstractOptions
{
    //
    // PROPERTIES
    //
    
    
    protected $cacheDir;
    protected $customLines = array();
    protected $disallowAll = false;
    protected $enableCache = false;
    protected $rules = array();
    protected $sitemapXmlPath = NULL;
    
    
    //
    // METHODS
    //
    
    
    public function getCacheDir()
    {
        return $this->cacheDir;
    }
    
    public function getCustomLines()
    {
        return $this->customLines;
    }
    
    public function getDisallowAll()
    {
        return $this->disallowAll;
    }
    
    public function getEnableCache()
    {
        return $this->enableCache;
    }
    
    public function getRules()
    {
        return $this->rules;
    }
    
    public function getSitemapXmlPath()
    {
        return $this->sitemapXmlPath;
    }
    
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }
    
    public function setCustomLines($customLines)
    {
        $this->customLines = $customLines;
    }
    
    public function setDisallowAll($boolean = false)
    {
        $this->disallowAll = $boolean;
    }
    
    public function setEnableCache($boolean = false)
    {
        $this->enableCache = $boolean;
    }
    
    public function setRules($rules)
    {
        $this->rules = $rules;
    }
    
    public function setSitemapXmlPath($sitemapXmlPath)
    {
        $this->sitemapXmlPath = $sitemapXmlPath;
    }
}