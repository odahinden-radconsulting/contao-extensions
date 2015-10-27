<?php
/**
 * Created by PhpStorm.
 * User: soifone
 * Date: 10/25/15
 * Time: 1:15 PM
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['text'] .=                         ';{bootstrap_legend_lg}' .
                                                                           ',' . tl_content_bootstrap::OFFSET_LG .
                                                                           ',' . tl_content_bootstrap::COLUMN_LG .
                                                                           ';' . '{bootstrap_legend_md}' .
                                                                           ',' . tl_content_bootstrap::OFFSET_MD .
                                                                           ',' . tl_content_bootstrap::COLUMN_MD .
                                                                           ';' . '{bootstrap_legend_sm}' .
                                                                           ',' . tl_content_bootstrap::OFFSET_SM .
                                                                           ',' . tl_content_bootstrap::COLUMN_SM .
                                                                           ';' . '{bootstrap_legend_xs}' .
                                                                           ',' . tl_content_bootstrap::OFFSET_XS .
                                                                           ',' . tl_content_bootstrap::COLUMN_XS;

/**
 * Fields
 */

$fields = array(
    tl_content_bootstrap::COLUMN_LG =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::COLUMN_LG],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::COLUMN_MD =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::COLUMN_MD],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::COLUMN_SM =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::COLUMN_SM],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::COLUMN_XS =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::COLUMN_XS],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'selectbootstrap',
        'options_callback'        => array('tl_content_bootstrap', 'getDevicesOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::OFFSET_LG =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::OFFSET_LG],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'eval'                    => array('tl_class' => 'w50 bootstrap-offset'),
        'options_callback'        => array('tl_content_bootstrap', 'getOffsetOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::OFFSET_MD =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::OFFSET_MD],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'eval'                    => array('tl_class' => 'w50 bootstrap-offset'),
        'options_callback'        => array('tl_content_bootstrap', 'getOffsetOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::OFFSET_SM =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::OFFSET_SM],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'eval'                    => array('tl_class' => 'w50 bootstrap-offset'),
        'options_callback'        => array('tl_content_bootstrap', 'getOffsetOptions'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    tl_content_bootstrap::OFFSET_XS =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_content'][tl_content_bootstrap::OFFSET_XS],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'eval'                    => array('tl_class' => 'w50 bootstrap-offset'),
        'options_callback'        => array('tl_content_bootstrap', 'getOffsetOptions'),
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
    const COLUMN_LG = 'bootstrap_column_lg';
    const COLUMN_MD = 'bootstrap_column_md';
    const COLUMN_SM = 'bootstrap_column_sm';
    const COLUMN_XS = 'bootstrap_column_xs';

    const OFFSET_LG = 'bootstrap_offset_lg';
    const OFFSET_MD = 'bootstrap_offset_md';
    const OFFSET_SM = 'bootstrap_offset_sm';
    const OFFSET_XS = 'bootstrap_offset_xs';

    /**
     * @param DataContainer $dc
     * @return string
     */
    public function getDevicesOptions(DataContainer $dc){
        return $GLOBALS['TL_LANG']['tl_content']['columns'];
    }

    /**
     * @param Datacontainer $dc
     * @return string
     */
    public function getOffsetOptions(Datacontainer $dc){
        return $GLOBALS['TL_LANG']['tl_content']['offset'];
    }
}