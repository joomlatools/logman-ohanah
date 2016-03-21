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
class PlgLogmanOhanahActivityAttendee extends ComLogmanModelEntityActivity
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'format'        => '{actor} {action} {object.type} name {object} {target.subtype} {target} {target.type}',
            'object_table'  => 'ohanah_tickets',
            'object_column' => 'ohanah_ticket_id'
        ));

        parent::_initialize($config);
    }

    protected function _objectConfig(KObjectConfig $config)
    {
        $config->append(array(
            'url' => 'option=com_ohanah&view=attendee&id=' . $this->row
        ));

        parent::_objectConfig($config);
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
            'url'        => sprintf('option=com_ohanah&view=event&id=%s', $event->id)
        ));
    }

    protected function _findActivityObject()
    {
        $result = parent::_findActivityObject();

        if ($result) {
            $result = $this->_findActivityTarget(); // Attendees cannot be reached if the event no longer exists.
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