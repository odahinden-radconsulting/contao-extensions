<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Olivier Dahinden
 *
 * @license GNU
 */

namespace Contao;


/**
 * Provide methods to handle select menus.
 *
 * @property boolean $mandatory
 * @property integer $size
 * @property boolean $multiple
 * @property array   $options
 * @property boolean $chosen
 *
 * @author Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
class SelectBootstrapMenu extends SelectMenu
{

    /**
     * Generate the widget and return it as string
     *
     * @return string
     */
    public function generate()
    {
        $arrOptions = array();
        $strClass = 'tl_select';

        if ($this->multiple)
        {
            $this->strName .= '[]';
            $strClass = 'tl_mselect';
        }

        // Add an empty option (XHTML) if there are none
        if (empty($this->arrOptions))
        {
            $this->arrOptions = array(array('value'=>'', 'label'=>'-'));
        }

        $selectedValue = 12;

        foreach ($this->arrOptions as $strKey=>$arrOption)
        {
            if ('selected' == trim($this->isSelected($arrOption))) {
                $selectedValue = $arrOption['value'];
            }

            if (isset($arrOption['value']))
            {
                $arrOptions[] = sprintf('<option value="%s"%s>%s</option>',
                    specialchars($arrOption['value']),
                    $this->isSelected($arrOption),
                    $arrOption['label']);
            }
            else
            {
                $arrOptgroups = array();

                foreach ($arrOption as $arrOptgroup)
                {
                    $arrOptgroups[] = sprintf('<option value="%s"%s>%s</option>',
                        specialchars($arrOptgroup['value']),
                        $this->isSelected($arrOptgroup),
                        $arrOptgroup['label']);
                }

                $arrOptions[] = sprintf('<optgroup label="&nbsp;%s">%s</optgroup>', specialchars($strKey), implode('', $arrOptgroups));
            }
        }

        if (0 == (int)$selectedValue) {
            $selectedValue = 'default';
        }

        // Chosen
        if ($this->chosen)
        {
            $strClass .= ' tl_chosen';
        }

        $imageContainer = '<script type="text/javascript">function bootstrapPreviewChange(e) { var value = "default"; if(0 != e.value) {value = e.value;} document.getElementById(\'div_\' + e.id).innerHTML = "<img src=\"system/modules/rad-bootstrap/assets/images/layout-" + value + ".png\" />";}</script><div id="div_ctrl_' . $this->strId . '"><img src="system/modules/rad-bootstrap/assets/images/layout-' . $selectedValue . '.png" /></div>';
        return $imageContainer . sprintf('<select onchange="bootstrapPreviewChange(this);" name="%s" id="ctrl_%s" class="%s%s"%s onfocus="Backend.getScrollOffset()">%s</select>%s',
            $this->strName,
            $this->strId,
            $strClass,
            (($this->strClass != '') ? ' ' . $this->strClass : ''),
            $this->getAttributes(),
            implode('', $arrOptions),
            $this->wizard);
    }
}
