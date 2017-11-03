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

class Firebear_CloudFlare_Model_System_Config_Source_Dropdown_Security
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'help',
                'label' => 'Help! I am under attack!',
            ),
            array(
                'value' => 'high',
                'label' => 'High',
            ),
            array(
                'value' => 'med',
                'label' => 'Medium',
            ),
            array(
                'value' => 'low',
                'label' => 'Low',
            ),
            array(
                'value' => 'eoff',
                'label' => 'Essentially off',
            ),
        );
    }
}