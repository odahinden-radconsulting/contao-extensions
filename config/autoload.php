<?php
/**
 * Created by PhpStorm.
 * User: soifone
 * Date: 10/25/15
 * Time: 2:40 PM
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Contao',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Widgets
    'Contao\SelectBootstrapMenu'                  => 'system/modules/contao-extensions-bootstrap/widgets/SelectBootstrapMenu.php'
));