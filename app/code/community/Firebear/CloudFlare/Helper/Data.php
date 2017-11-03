<?php
/**
 * Firebear CloudFlare Control Module
 *
 * @category    Firebear
 * @package     Firebear_CloudFlare
 * @copyright   Copyright (c) 2013 Firebear
 * @author      biotech (Hlupko Viktor)
 */

/**
 *
 *
 * @category    Firebear
 * @package     Firebear_CloudFlare
 */
class Firebear_CloudFlare_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	public function cf(){
	
		$cf = new CloudFlare_Api(Mage::getStoreConfig('cloudflare/apioptions/api_email'), Mage::getStoreConfig('cloudflare/apioptions/api_key'));
		
		return $cf;
	}
	
	public function checkConfig($var = FALSE){
		
		$cf = Mage::helper('cloudflare')->cf();
	    
	    if ($var){
	    	$result = $cf->zone_settings(Mage::helper('cloudflare')->url())->response->result->objs[0]->$var;
	    }else{
		    $result = $cf->zone_settings(Mage::helper('cloudflare')->url());
	    }
	
		return $result;
	}
	
	public function checkApi(){
		
		$result = Mage::helper('cloudflare')->checkConfig()->result;
		
		if (strstr($result, "success")){
			return true;
		}elseif(strstr($result, "error")){
			Mage::getSingleton('adminhtml/session')->addError('Incorrect CloudFlare API access details!');
			return false;
		}
	}
	
	public function loadConfig(){
		
		$cf = Mage::helper('cloudflare')->cf();
	    
	    $config = new Mage_Core_Model_Config();	    
	    	    	    
	    $sec_lvl = Mage::helper('cloudflare')->checkConfig("sec_lvl");
	    
	    $devmode = Mage::helper('cloudflare')->checkConfig("dev_mode");
	    
	    $ipv46 = Mage::helper('cloudflare')->checkConfig("ipv46");
	    
	    $minify = Mage::helper('cloudflare')->checkConfig("minify");
	    
	    $async = Mage::helper('cloudflare')->checkConfig("async");
	    
	    $cache_lvl = Mage::helper('cloudflare')->checkConfig("cache_lvl");

		if (Mage::helper('cloudflare')->checkApi()){
	    
		    if (!empty($sec_lvl)){
				if($config->saveConfig('cloudflare/overview/security', $sec_lvl, 'default', 0)){
					Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct. CloudFlare config data loaded.'); 
				}else{
					Mage::getSingleton('adminhtml/session')->addError('Error in security level update');
				}
		    }
		    
		    if (!empty($cache_lvl)){
				if($config->saveConfig('cloudflare/overview/cachelvl', $cache_lvl, 'default', 0)){
					//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct. CloudFlare config data loaded.'); 
				}else{
					Mage::getSingleton('adminhtml/session')->addError('Error in cachelvl update');
				}
		    }
		    
		    if ($devmode > 0){
				if($config->saveConfig('cloudflare/overview/devmode', 1, 'default', 0)){
					//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct. CloudFlare config data loaded.'); 
				}else{	
					$result = 'error in update dev_mode';
					Mage::getSingleton('adminhtml/session')->addError('Error in dev_mode update');
				}
		    }else{
			    if($config->saveConfig('cloudflare/overview/devmode', 0, 'default', 0)){
				    
			    }else{
				    Mage::getSingleton('adminhtml/session')->addError('Error in dev_mode update');
			    }
		    }
		    
		    if ($ipv46 > 0){
				if($config->saveConfig('cloudflare/overview/ipv46', 1, 'default', 0)){
					//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct. CloudFlare config data loaded.'); 
				}else{	
					$result = 'error in update $ipv46';
					Mage::getSingleton('adminhtml/session')->addError('Error in ipv46 update');
				}
		    }else{
			    if($config->saveConfig('cloudflare/overview/ipv46', 0, 'default', 0)){
				    
			    }else{
				    Mage::getSingleton('adminhtml/session')->addError('Error in $ipv46 update');
			    }
		    }
		    
		    if (!empty($minify)){
			    if($config->saveConfig('cloudflare/overview/minify', $minify, 'default', 0)){
					//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct. CloudFlare config data loaded.'); 
				}else{	
					$result = 'error in update $ipv46';
					Mage::getSingleton('adminhtml/session')->addError('Error in ipv46 update');
				}
		    }
		    
		    if (!empty($async)){
			    if($config->saveConfig('cloudflare/overview/async', $async, 'default', 0)){
					//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct. CloudFlare config data loaded.'); 
				}else{	
					$result = 'error in update async';
					Mage::getSingleton('adminhtml/session')->addError('Error in async update');
				}
		    }
		    
		    return true;
		}else{
			return false;
		}
	    
	    
		
	}
	
	public function saveConfig(){
		
		if (Mage::helper('cloudflare')->checkApi()){     
        
	        $cf = Mage::helper('cloudflare')->cf();
	        
	        $cf->sec_lvl(Mage::helper('cloudflare')->url(), Mage::getStoreConfig('cloudflare/overview/security'));
	        
	        $cf->devmode(Mage::helper('cloudflare')->url(), Mage::getStoreConfig('cloudflare/overview/devmode'));
	        
	        $cf->ipv46(Mage::helper('cloudflare')->url(), Mage::getStoreConfig('cloudflare/overview/ipv46'));
	        
	        $cf->minify(Mage::helper('cloudflare')->url(), Mage::getStoreConfig('cloudflare/overview/minify'));
	        
	        $cf->async(Mage::helper('cloudflare')->url(), Mage::getStoreConfig('cloudflare/overview/async'));
	        
	        $cf->cache_lvl(Mage::helper('cloudflare')->url(), Mage::getStoreConfig('cloudflare/overview/cachelvl'));
	                
	        Mage::getSingleton('adminhtml/session')->addSuccess('CloudFlare configuration updated!');
	    
	    }
	    
	    return true;
		
	}
	
	public function url(){
		$magento_url = str_replace('www.', '', parse_url(Mage::getBaseUrl (Mage_Core_Model_Store::URL_TYPE_WEB), PHP_URL_HOST));
		//if (Mage::helper('cloudflare')->getZone() > 0){
			return $magento_url;
		//}
	}
	
	public function getZone(){
		
		$magento_url = str_replace('www.', '', parse_url(Mage::getBaseUrl (Mage_Core_Model_Store::URL_TYPE_WEB), PHP_URL_HOST));
		
		$cf = Mage::helper('cloudflare')->cf();
		
		$request = $cf->zone_check($magento_url);
		
		if (strstr($request->result, "success")){
			$zone_id = $request->response->zones->$magento_url;
			
			if ($zone_id > 0){
				
				return $zone_id;
				
			}else{
				return false;
			}
		}
		
	}
	
	function formatSizeUnits($bytes)
    {
        $bytes = round(($bytes / 1024), 2);

        return $bytes." MB";
	}
	
}