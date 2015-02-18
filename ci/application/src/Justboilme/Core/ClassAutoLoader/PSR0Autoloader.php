<?php

/**
 * PSR-0 compliant autoloader
 *
 * @author czarpino
 */
class PSR0Autoloader
{
    /**
     * Base dir of class files to be autoloaded
     * 
     * @var string
     */
    private $_includePath = '';
    
    /**
     * Constructor.
     */
    public function __construct($includePath)
    {
        $this->setIncludePath($includePath);
    }
    
    /**
     * Set the base include path for class files to be loaded by this autoloader
     * 
     * @param string $includePath
     * 
     * @return \PSR0Autoloader
     */
    public function setIncludePath($includePath)
    {
        $includePath = rtrim(trim ($includePath), DIRECTORY_SEPARATOR);
        if (0 !== strlen($includePath)) {
            $includePath .= DIRECTORY_SEPARATOR;
        }
        
        $this->_includePath = $includePath;
        
        return $this;
    }
    
    /**
     * Retrieve base include path
     * 
     * @return string
     */
    public function getIncludePath()
    {
        return $this->_includePath;
    }
    
    /**
     * Register this class loader to the SPL autoload stack
     */
    public function register()
    {
        spl_autoload_register(array ($this, 'loadClass'));
    }
    
    /**
     * Unregister this class loader from the SPL autoload stack
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
    
    /**
     * Load the given class
     * 
     * @param string $className A fully-qualified namespace and class name
     */
    public function loadClass($className)
    {

        /* 
         * Hack to avoid handling annoying CI & friends classes. Ideally, this
         * should be placed in MY_Controller.
         *
         */

        if (FALSE !== stripos($className, '_')){
            return;
        }

        $className = ltrim($className, '\\');
        $namespacePath = '';
        
        if (FALSE !== ($lastNsPos = strrpos($className, '\\'))) {
            $namespacePath = str_replace('\\', DIRECTORY_SEPARATOR, substr($className, 0, $lastNsPos)) . DIRECTORY_SEPARATOR;
            $className = substr($className, $lastNsPos + 1);
        }

        require $this->_includePath . $namespacePath . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    }
}
