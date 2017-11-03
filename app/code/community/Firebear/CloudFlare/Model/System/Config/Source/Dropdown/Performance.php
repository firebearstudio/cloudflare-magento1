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

class Firebear_CloudFlare_Model_System_Config_Source_Dropdown_Performance
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'cdn_only',
                'label' => 'CDN Only',
            ),
            array(
                'value' => 'cdn_basic',
                'label' => 'CDN + Basic optmizations',
            ),
            array(
                'value' => 'cdn_full',
                'label' => 'CDN + Full optimizations',
            ),
            array(
                'value' => 'custom',
                'label' => 'Custom',
            ),
        );
    }
}