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

class Firebear_CloudFlare_Model_System_Config_Source_Dropdown_Stats
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '20',
                'label' => 'Past 30 days',
            ),
            array(
                'value' => '30',
                'label' => 'Past 7 days',
            ),
            array(
                'value' => '40',
                'label' => 'Past day',
            ),
            array(
                'value' => '100',
                'label' => '24 hours ago (PRO)',
            ),
            array(
                'value' => '110',
                'label' => '12 hours ago (PRO)',
            ),
            array(
                'value' => '120',
                'label' => '16 hours ago (PRO)',
            ),
        );
    }
}

