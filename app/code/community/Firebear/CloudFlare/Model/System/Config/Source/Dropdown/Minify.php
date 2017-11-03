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

class Firebear_CloudFlare_Model_System_Config_Source_Dropdown_Minify
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '0',
                'label' => 'Off',
            ),
            array(
                'value' => '1',
                'label' => 'JavaScript only',
            ),
            array(
                'value' => '2',
                'label' => 'CSS only',
            ),
            array(
                'value' => '3',
                'label' => 'JavaScript and CSS',
            ),
            array(
                'value' => '4',
                'label' => 'HTML only',
            ),
            array(
                'value' => '5',
                'label' => 'JavaScript and HTML',
            ),
            array(
                'value' => '6',
                'label' => 'CSS and HTML',
            ),
            array(
                'value' => '7',
                'label' => 'CSS, JavaScript, and HTML',
            ),
        );
    }
}
