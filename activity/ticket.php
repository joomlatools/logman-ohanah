<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2015 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Attendee Activity Entity
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanOhanahActivityTicket extends PlgLogmanOhanahActivityAttendee
{
    protected $_unassigned;

    protected function _initialize(KObjectConfig $config)
    {
        // TODO: Improve check for unassigned tickets (metadata???).
        if ($this->_unassigned = empty(trim($config->data->title))) {
            $config->append(array('format' => '{actor} {action} {object.type} {target.subtype} {target} {target.type}'));
        }

        parent::_initialize($config);
    }

    public function getPropertyImage()
    {
        if ($this->verb == 'order') {
            $image = 'icon-shopping-cart';
        } else {
            $image = parent::getPropertyImage();
        }

        return $image;
    }

    protected function _objectConfig(KObjectConfig $config)
    {
        if ($this->_unassigned)
        {
            $config->append(array(
                'type' => array(
                    'find' => 'object',
                    'url'  => sprintf('option=com_ohanah&view=attendee&id=%s', $this->row)
                )
            ));
        }

        parent::_objectConfig($config);
    }
}