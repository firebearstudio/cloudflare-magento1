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

class Firebear_CloudFlare_Adminhtml_CloudflareController extends Mage_Adminhtml_Controller_Action
{

    public function checkAction()
    {
        
        $cf = new CloudFlare_Api($this->getRequest()->getPost("api_email"), $this->getRequest()->getPost("api_key")); 
        
       	
       	       
        $request = $cf->stats(Mage::helper('cloudflare')->url(), $cf::INTERVAL_30_DAYS);       
        $config = new Mage_Core_Model_Config();
		
        if (strstr($request->result, "success")){   
        	$config->saveConfig('cloudflare/apioptions/api_email', $this->getRequest()->getPost("api_email"), 'default', 0);
        	$config->saveConfig('cloudflare/apioptions/api_key', $this->getRequest()->getPost("api_key"), 'default', 0);
	        $result = 1;
        }else{
        	//print_r ($request); 
        	$config->saveConfig('cloudflare/apioptions/api_email', $this->getRequest()->getPost("api_email"), 'default', 0);
        	$config->saveConfig('cloudflare/apioptions/api_key', $this->getRequest()->getPost("api_key"), 'default', 0);
	        $result = 0;
        }
        
		//$result = $this->getRequest()->getPost("api_email");    
               	
        Mage::app()->getResponse()->setBody($result);
    }
    
    public function cleanCacheAction(){
	    
	    $request = Mage::helper('cloudflare')->cf()->fpurge_ts(Mage::helper('cloudflare')->url());

	    
	    if (strstr($request->result, "success")){
	    	//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct!');
	    	$result = 1;
        }else{
        	Mage::getSingleton('adminhtml/session')->addError('Error in clean cache!');
        	$result = 0;
        }
        
        Mage::app()->getResponse()->setBody($result);
	    
    }
    
    public function cleanCacheUrlAction(){
    
    	$url = $this->getRequest()->getPost("url");

    	
    	if (!empty($url)){
	    	$request = Mage::helper('cloudflare')->cf()->zone_file_purge(Mage::helper('cloudflare')->url(), $url);
    	}
	    
	    if (strstr($request->result, "success")){
	    	//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct!');
	    	$result = 1;
        }elseif(strstr($request->result, "error")){
        	Mage::getSingleton('adminhtml/session')->addError('Error in purge cache file');
        	$result = 0;
        }
        
        Mage::app()->getResponse()->setBody($result);
	    
    }
    
    public function ipListAction(){
    
    	$ip = $this->getRequest()->getPost("ip");
    	
    	$action = $this->getRequest()->getPost("action");
    	
    	if (!empty($action) && !empty($ip)){
	    	
	    	if (strstr($action, "blacklist")){
		    	$request = Mage::helper('cloudflare')->cf()->ban($ip);
	    	}
	    	
	    	if (strstr($action, "whitelist")){
		    	$request = Mage::helper('cloudflare')->cf()->wl($ip);
	    	}
	    	
	    	if (strstr($action, "unlist")){
		    	$request = Mage::helper('cloudflare')->cf()->nul($ip);
	    	}
	    	
	    	if (strstr($request->result, "success")){
	    		//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct!');
	    		$result = 1;
	        }elseif(strstr($request->result, "error")){
	        	Mage::getSingleton('adminhtml/session')->addError('Error in action with IP');
	        	$result = 0;
	        }
    	}
        
        Mage::app()->getResponse()->setBody($result);
	    
    }
    
    public function zoneGrabAction(){
	    
		    $request = Mage::helper('cloudflare')->cf()->update_image(Mage::helper('cloudflare')->getZone());
		    
		    if (strstr($request->result, "success")){
		    		//Mage::getSingleton('adminhtml/session')->addSuccess('API Access details correct!');
		    		$result = 1;
		        }else{
		        	Mage::getSingleton('adminhtml/session')->addError('Error in create snapshoot');
		        	$result = 0;
		        }
		   
		   //Zend_Debug::dump($request);
		       
		   Mage::app()->getResponse()->setBody($result);
    }
    
    public function getIpListAction(){
	    
	    $request = Mage::helper('cloudflare')->cf()->zone_ips(Mage::helper('cloudflare')->url());
		
		if (strstr($request->result, "success")){
		
				echo '<style type="text/css">
						.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
						.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
						.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
						.tg .tg-l77s{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
						</style>
						<table class="tg">
						  <tr>
						    <th class="tg-l77s">IP</th>
						    <th class="tg-l77s">Hits</th>
						    <th class="tg-l77s">Classification</th>
						    <!--<th class="tg-l77s">Geo coordinates (latitude:longitude)</th>-->
						  </tr>';
						  					echo '<tr>
						    <td class="tg-031e"></td>
						    <td class="tg-031e"></td>
						    <td class="tg-031e"></td>
						    <td class="tg-031e"></td>
						  </tr>';


	    		foreach ($request->response->ips as $ip){

		    		//	echo $ip->ip."|".$ip->hits."|".$ip->classification."|".$ip->latitude."|".$ip->longitude."<br />";
		    		
		    		echo ' <tr>
					    <td class="tg-031e">'.$ip->ip.'</td>
					    <td class="tg-031e">'.$ip->hits.'</td>
					    <td class="tg-031e">'.$ip->classification.'</td>
					    <!--<td class="tg-031e">'.$ip->latitude.' : '.$ip->longitude.'</td>-->
					  </tr>';
		    			
	    		}
	    		
	    		echo '</table>';
	    }else{
	        	echo ('Error in get IP list');
	   }
	    
	    
    }
    
    public function statsAction(){
	    $interval = $this->getRequest()->getPost("interval");
	    
	    if ($interval >0){
			$request = Mage::helper('cloudflare')->cf()->stats(Mage::helper('cloudflare')->url(), $interval); 	  
	    }
	   
	    
	    Mage::app()->getResponse()->setBody('<style type="text/css">
						.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
						.tg td{font-family:Arial, sans-serif;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
						.tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
						.tg .tg-l77s{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
						</style>
						<table class="tg" id="cloudflare_stats_table">
						  <tr>
						    <th class="tg-l77s">Pageviews</th>
						  </tr>
						  <tr>
						    <td class="tg-031e">Regular: '.$request->response->result->objs[0]->trafficBreakdown->pageviews->regular.'</td>
						    <td class="tg-031e">Threat: '.$request->response->result->objs[0]->trafficBreakdown->pageviews->threat.'</td>
						    <td class="tg-031e">Crawler: '.$request->response->result->objs[0]->trafficBreakdown->pageviews->crawler.'</td>
						  </tr>
						  <tr>
						    <th class="tg-l77s">Unique visitors</th>
						  </tr>
						  <tr>
						    <td class="tg-031e">Regular: '.$request->response->result->objs[0]->trafficBreakdown->uniques->regular.'</td>
						    <td class="tg-031e">Threat: '.$request->response->result->objs[0]->trafficBreakdown->uniques->threat.'</td>
						    <td class="tg-031e">Crawler: '.$request->response->result->objs[0]->trafficBreakdown->uniques->crawler.'</td>
						  </tr>
						  <tr>
						    <th class="tg-l77s">Requests saved</th>
						  </tr>
						  <tr>
						    <td class="tg-031e">Requests saved: '.$request->response->result->objs[0]->requestsServed->cloudflare.'</td>
						    						    
						  </tr>
						    <tr>
						    <th class="tg-l77s">Bandwidth saved</th>
						  </tr>
						  <tr>
						    <td class="tg-031e">Bandwidth saved: '.Mage::helper('cloudflare')->formatSizeUnits($request->response->result->objs[0]->bandwidthServed->cloudflare).'</td>
						    						  	  </tr>
						</table>');	
    }
    
    public function loadConfigAction(){
    
    	Mage::helper('cloudflare')->loadConfig();
    		    
	    Mage::app()->getResponse()->setBody(1);
	    	    
    }
}