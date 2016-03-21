<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2015 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Ohanah LOGman plugin.
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanOhanah extends ComLogmanPluginKoowa
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'controllers' => array(
                'com://admin/ohanah.controller.event'    => 'com://admin/logman.activity.logger',
                'com://site/ohanah.controller.event'     => 'com://admin/logman.activity.logger',
                'com://admin/ohanah.controller.category' => 'plg:logman.ohanah.logger.category',
                'com://admin/ohanah.controller.attendee' => 'plg:logman.ohanah.logger.attendee',
                'com://site/ohanah.controller.ticket'    => 'plg:logman.ohanah.logger.attendee',
            )
        ));

        parent::_initialize($config);
    }
}