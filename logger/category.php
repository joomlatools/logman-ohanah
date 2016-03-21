<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2015 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Category Ohanah Logger
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanOhanahLoggerCategory extends ComLogmanActivityLogger
{
    public function log($action, KModelEntityInterface $object, KObjectIdentifierInterface $subject)
    {
        // Sort calls act as an entity edit without actually editing the entity itself.
        if ($action != 'after.edit' || $object->getStatus() !== KModelEntityInterface::STATUS_FETCHED) {
            parent::log($action, $object, $subject);
        }
    }
}