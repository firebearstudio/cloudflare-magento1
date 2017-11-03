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
 
class Firebear_CloudFlare_Block_Adminhtml_System_Config_Form_CacheButton extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('firebear/cloudflare/system/config/cachebutton.phtml');
    }
 
    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
 
    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getAjaxCheckUrl()
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/adminhtml_cloudflare/cleancache');
    }
 
    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
            'id'        => 'cloudflare_cachebutton',
            'label'     => $this->helper('adminhtml')->__('Clean cache'),
            'onclick'   => 'javascript:cleanCache(); return false;'
        ));
 
        return $button->toHtml();
    }

}