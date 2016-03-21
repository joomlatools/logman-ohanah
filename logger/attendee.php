<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2015 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Attendee Ohanah Logger
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanOhanahLoggerAttendee extends ComLogmanActivityLogger
{
    public function getActivityData(KModelEntityInterface $object, KObjectIdentifierInterface $subject)
    {
        $data = parent::getActivityData($object, $subject);

        $fields = json_decode($object->fields);

        $data['title'] = sprintf('%s %s', $fields->first_name, $fields->last_name);

        $event = $object->event;

        if (count($event) == 1 and !$event->isNew()) {
            $data['metadata'] = array('event' => array('id' => $event->id, 'title' => $event->title));
        }

        if ($subject->getName() == 'ticket')
        {
            $data['action'] = 'order';
            $data['status'] = 'ordered';
        }

        return $data;
    }
}