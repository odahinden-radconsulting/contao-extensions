<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   RadExtensions
 * @author    Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license   GNU
 * @copyright 2015
 */


/**
 * Back end form fields
 */
$GLOBALS['BE_FFL']['selectbootstrap'] = 'SelectBootstrapMenu';

if (TL_MODE == 'BE') {
    $GLOBALS['TL_CSS'][] = 'system/modules/contao-extensions-bootstrap/assets/css/backend/bootstrap.main.css|screen';
    $GLOBALS['TL_JAVASCRIPT'][] = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/contao-extensions-bootstrap/assets/js/backend/bootstrap.control.js';
}
