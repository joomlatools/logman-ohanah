<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2016 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Category Activity Entity
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanOhanahActivityCategory extends ComLogmanModelEntityActivity
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'format'        => '{actor} {action} {object.subtype} {object.type} title {object}',
            'object_table'  => 'ohanah_categories',
            'object_column' => 'ohanah_category_id'
        ));

        parent::_initialize($config);
    }

    protected function _objectConfig(KObjectConfig $config)
    {
        $config->append(array(
            'subtype' => array('objectName' => 'Ohanah', 'object' => true),
            'url'     => array('admin' => 'option=com_ohanah&view=category&id=' . $this->row)
        ));

        parent::_objectConfig($config);
    }
}