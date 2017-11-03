<?php
/**
 * Firebear CloudFlare Control Module
 *
 * @category    Firebear
 * @package     Firebear_CloudFlare
 * @copyright   Copyright (c) 2014 Firebear
 * @author      biotech (Hlupko Viktor)
 */

/**
 *
 *
 * @category    Firebear
 * @package     Firebear_CloudFlare
 */
 
class Firebear_CloudFlare_Helper_Cloudflarehttp extends Mage_Core_Helper_Http{
 
    public function getRemoteAddr($ipToLong = false){        
        if (is_null($this->_remoteAddr)) {
            if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $this->_remoteAddr = $_SERVER["HTTP_CF_CONNECTING_IP"];
            }
            else    {
                $this->_remoteAddr = parent::getRemoteAddr(false);
            }
        }  
        
        return $ipToLong ? ip2long($this->_remoteAddr) : $this->_remoteAddr;
	}
}
?>