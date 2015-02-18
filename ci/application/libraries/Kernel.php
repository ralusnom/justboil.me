<?php

class Kernel
{    
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_bootstrap();
    }
    
    /**
     * Perform boostrap operations.
     */
    private function _bootstrap()
    {
        /* We register 3rd party autoloader */
        require APPPATH.'../vendor/AWS/aws-autoloader.php';
        
         /* We register the application class autoloader */
        require_once APPPATH . 'src/Justboilme/Core/ClassAutoLoader/PSR0Autoloader.php';
        $psr0Autoloader = new PSR0Autoloader(APPPATH . "src/");
        $psr0Autoloader->register();
    }

}
