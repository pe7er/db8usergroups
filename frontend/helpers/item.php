<?php

/**
 * @package     db8 locate
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

class Db8usergroupsHelperItem {

    public static function category($catid) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title');
        $query->from('#__categories');
        $query->where('id = '.$catid);
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }

}    
