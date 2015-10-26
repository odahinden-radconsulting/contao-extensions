<?php
/**
 * Created by PhpStorm.
 * User: soifone
 * Date: 10/24/15
 * Time: 1:03 PM
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_theme']['palettes']['default'] .= ';{bootstrap_legend},bootstrap_active';
$GLOBALS['TL_DCA']['tl_theme']['palettes']['__selector__'][] = 'bootstrap_active';
$GLOBALS['TL_DCA']['tl_theme']['subpalettes']['bootstrap_active'] = 'bootstrap_version,bootstrap_defaul_css_url,bootstrap_defaul_theme_url,bootstrap_defaul_js_url';

/**
 * Fields
 */

$fields = array(
    'bootstrap_active' =>  array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['bootstrap_active'],
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => array('submitOnChange' => true, 'tl_class'=>'w50 m12'),
        'save_callback'           => array(
                                        array('tl_theme_bootstrap', 'processBootstrap')
                                     ),
        'sql'                     => "char(1) NOT NULL default ''"
    ),

    'bootstrap_version' => array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['bootstrap_version'],
        'default'                 => 1,
        'exclude'                 => true,
        'search'                  => true,
        'filter'                  => true,
        'sorting'                 => true,
        'inputType'               => 'select',
        'options'                 => array(1 => 'Version 3.0'),
        'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
        'sql'                     => "int(3) unsigned NOT NULL default '0'",
    ),

    'bootstrap_defaul_css_url' => array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['bootstrap_defaul_css_url'],
        'exclude'                 => true,
        'search'                  => true,
        'default'                 => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
        'inputType'               => 'text',
        'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                     => "varchar(255) COLLATE utf8_bin NOT NULL default ''"
    ),

    'bootstrap_defaul_theme_url' => array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['bootstrap_defaul_theme_url'],
        'exclude'                 => true,
        'search'                  => true,
        'inputType'               => 'text',
        'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                     => "varchar(255) COLLATE utf8_bin NOT NULL default ''"
    ),

    'bootstrap_defaul_js_url' => array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['bootstrap_defaul_js_url'],
        'exclude'                 => true,
        'search'                  => true,
        'default'                 => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
        'inputType'               => 'text',
        'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                     => "varchar(255) COLLATE utf8_bin NOT NULL default ''"
    )
);

$GLOBALS['TL_DCA']['tl_theme']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_theme']['fields'], $fields);

/**
 * Class tl_theme_bootstrap
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2015 RAD Consulting GmbH
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @package
 */
class tl_theme_bootstrap extends Backend
{

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $target;

    /**
     * random contao comment
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * @param $value
     * @param DataContainer $dc
     * @return mixed
     */
    public function processBootstrap($value, DataContainer $dc)
    {
        if (1 == $value){
            $this->generateTemplates();

            $this->Database->prepare("UPDATE tl_theme set templates = ? WHERE id = ?")
                ->limit(1)
                ->execute(array('templates/bootstrap', $dc->id));

            return $value;
        }

        $t = $this->getTarget();
        $this->removeFiles($t);
        rmdir($t);
        $this->Database->prepare("UPDATE tl_theme set templates = ? WHERE id = ?")
            ->limit(1)
            ->execute(array('', $dc->id));
        System::log("Deleted templates '{$t}'", __METHOD__, TL_FILES);
    }

    /**
     * @throws Exception
     */
    public function generateTemplates()
    {
        System::log("Start generating Templates", __METHOD__, TL_FILES);
        try {
            $this->copyDirectory($this->getSource(), $this->getTarget());
        } catch (Exception $e) {
            System::log("An Error occured: '{$e->getMessage()}'", __METHOD__, TL_ERROR);
            throw $e;
        }
        System::log("End generating Templates", __METHOD__, TL_FILES);
    }

    /**
     * @param $target
     */
    protected function removeFiles($target)
    {
        /** @var \SplFileInfo $directoryIterator */
        $directoryIterator = new DirectoryIterator($target);

        foreach($directoryIterator as $file) {
            if (!$file->isFile()) {
                continue;
            }

            unlink($target . '/' . $file->getFilename());
        }
    }

    /**
     * @param string $source
     * @throws RuntimeException
     */
    protected function setSource($source)
    {
        if (!is_dir($source)) {
            throw new RuntimeException("Source '{$source}' does not exists. Unable to copy");
        }

        $this->source = $source;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    protected function getSource()
    {
        if (empty($this->source)) {
            $this->setSource(__DIR__ . '/../templates/bootstrap');
            System::log("Source left empty. Use fallback '{$this->source}'", __METHOD__, TL_FILES);
        }

        return $this->source;
    }

    /**
     * @param $target
     */
    protected function setTarget($target)
    {

        if (!is_dir($target)) {
            mkdir($target);
            System::log("Generated '{$target}'", __METHOD__, TL_FILES);
        }

        $this->target = $target;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    protected function getTarget()
    {
        if (empty($this->target)) {
            $this->setTarget(__DIR__ . '/../../../../templates/bootstrap');
            System::log("Target left empty. Use fallback '{$this->target}'", __METHOD__, TL_FILES);
        }

        return $this->target;
    }

    /**
     * @param $source
     * @param $target
     * @throws RuntimeException
     */
    protected function copyDirectory($source, $target)
    {
        /** @var \SplFileInfo $directoryIterator */
        $directoryIterator = new DirectoryIterator($source);

        if (count(glob($target . '/*')) > 0) {
            throw new RuntimeException("Target folder is not empty. Please remove '{$target}' in order to copy templates");
        }

        foreach ($directoryIterator as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $s = $source . '/' . $file->getFilename();
            $t = $target . '/' . $file->getFilename();

            copy($s, $t);
            System::log("Copied '{$s}' to '{$t}'", __METHOD__, TL_FILES);
        }
    }
}