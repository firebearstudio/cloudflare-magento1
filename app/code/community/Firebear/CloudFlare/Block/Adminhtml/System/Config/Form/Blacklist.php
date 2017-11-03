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
 
class Firebear_CloudFlare_Block_Adminhtml_System_Config_Form_Blacklist extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('firebear/cloudflare/system/config/blacklistbutton.phtml');
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

    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
            'id'        => 'cloudflare_blacklist',
            'label'     => $this->helper('adminhtml')->__('Blacklist'),
            'onclick'   => 'javascript:blackList(); return false;'
        ));
 
        return $button->toHtml();
    }

}