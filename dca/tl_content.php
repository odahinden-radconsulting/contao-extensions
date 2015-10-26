<?php
/**
 * Created by PhpStorm.
 * User: soifone
 * Date: 10/25/15
 * Time: 1:15 PM
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['text'] .= ';{bootstrap_legend},bootstrap_chosen_lg,bootstrap_chosen_md,bootstrap_chosen_sm,bootstrap_chosen_xs';

/**
 * Fields
 */

$fields = array(
    tl_content_bootstrap::DEVICE_LG =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::DEVICE_LG],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'eval'                    => array('submitOnChange'=>true),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::DEVICE_MD =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::DEVICE_MD],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'eval'                    => array('chosen'=>true, 'submitOnChange'=>true),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::DEVICE_SM =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::DEVICE_SM],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'eval'                    => array('chosen'=>true, 'submitOnChange'=>true),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::DEVICE_XS =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::DEVICE_XS],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'eval'                    => array('chosen'=>true, 'submitOnChange'=>true),
        'sql'                     => "varchar(255) NOT NULL default ''"
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_content']['fields'], $fields);

/**
 * Class tl_content_bootstrap
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2015 RAD Consulting GmbH
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @package
 */
class tl_content_bootstrap extends Backend
{
    const DEVICE_LG = 'bootstrap_chosen_lg';
    const DEVICE_MD = 'bootstrap_chosen_md';
    const DEVICE_SM = 'bootstrap_chosen_sm';
    const DEVICE_XS = 'bootstrap_chosen_xs';

    public function getDevicesOptions(DataContainer $dc){
        return $GLOBALS['TL_LANG']['tl_content']['columns'];
    }
}