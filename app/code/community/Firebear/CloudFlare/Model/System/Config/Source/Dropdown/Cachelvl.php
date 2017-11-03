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

class Firebear_CloudFlare_Model_System_Config_Source_Dropdown_Cachelvl
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'agg',
                'label' => 'Aggressive',
            ),
            array(
                'value' => 'basic',
                'label' => 'Basic',
            ),
        );
    }
}