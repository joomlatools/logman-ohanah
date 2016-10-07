<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2016 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Ticket Activity Entity
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanOhanahActivityTicket extends ComLogmanModelEntityActivity
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'format'        => '{actor} {action} {object.type} {target.subtype} {target} {target.type}',
            'object_table'  => 'ohanah_tickets',
            'object_column' => 'ohanah_ticket_id'
        ));

        parent::_initialize($config);
    }

    protected function _objectConfig(KObjectConfig $config)
    {
        $config->append(array(
            'url' => array('admin' => 'option=com_ohanah&view=attendee&id=' . $this->row)
        ))->append(array('type' => array('find' => 'object', 'url' => $config->url)));

        parent::_objectConfig($config);
    }

    protected function _actionConfig(KObjectConfig $config)
    {
        if ($this->verb == 'add') {
            $config->append(array('objectName' => 'ordered'));
        }

        parent::_actionConfig($config);
    }

    public function getPropertyImage()
    {
        if ($this->verb == 'add') {
            $image = 'icon-shopping-cart';
        } else {
            $image = parent::getPropertyImage();
        }

        return $image;
    }

    public function getPropertyTarget()
    {
        $metadata = $this->getMetadata();

        $event = $metadata->event;

        return $this->_getObject(array(
            'subtype'    => array('object' => true, 'objectName' => 'Ohanah'),
            'type'       => array(
                'object'     => true,
                'objectName' => 'event'
            ),
            'objectName' => $metadata->event->title,
            'find'       => 'target',
            'url'        => array('admin' => sprintf('option=com_ohanah&view=event&id=%s', $event->id))
        ));
    }

    protected function _findActivityObject()
    {
        $result = parent::_findActivityObject();

        if ($result) {
            $result = $this->_findActivityTarget(); // Tickets cannot be reached if the event no longer exists.
        }

        return $result;
    }

    protected function _findActivityTarget()
    {
        $query = $this->getObject('lib:database.query.select')
                      ->columns('COUNT(*)')
                      ->table('ohanah_events')
                      ->where('ohanah_event_id = :value')
                      ->bind(array('value' => $this->getMetadata()->event->id));

        // Need to catch exceptions here as table may not longer exist.
        try {
            $result = $this->getTable()->getAdapter()->select($query, KDatabase::FETCH_FIELD);
        } catch (Exception $e) {
            $result = 0;
        }

        return $result;
    }
}