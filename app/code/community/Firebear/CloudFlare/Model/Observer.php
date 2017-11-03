<?php
class Firebear_CloudFlare_Model_Observer extends Mage_Core_Model_Abstract {
    
    public function __construct() { }
    
    public function gimmeacall( $observer ) {
        $event = $observer->getEvent();
        
        Mage::helper('cloudflare')->saveConfig();
        
        return $this;
    }
    
}
?>