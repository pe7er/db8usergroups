<?php

/**
 * @package     db8 locate
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

class Db8usergroupsHelperCategories
{
	public static function oldcategories($category)
	{
		// Get the event ID
		$params = JFactory::getApplication()->getPageParameters('com_db8usergroups');
		$category = $params->get('category', 0);
		
		$categories = FOFModel::getTmpInstance('Categories', 'CategoryModel')
			->limit(0)
			->limitstart(0)
			->enabled(1)
			->catid($category)
			->filter_order('title')
			->filter_order_Dir('ASC')
			->getList();
					
		return $categories;
	}
        
        public static function getCategories()
        {
                // Initialize variables.
                $options = array();
 
                $db     = JFactory::getDbo();
                $query  = $db->getQuery(true);
                
                $query->select('node.id AS value, IF(node.level = 2, node.title, CONCAT("--",node.title)) AS text ');                
                $query->from('#__categories AS node, #__categories AS parent');
                $query->where('node.extension = "com_db8usergroups" AND parent.extension = "com_db8usergroups"');
                $query->where('node.level > 1');
                $query->where('node.lft BETWEEN parent.lft AND parent.rgt');// AND parent.id = 205 AND node.id <> 205');
                $query->group('value');
                $query->order('node.lft');
                
               // echo "options=".$query;
                // Get the options.
                $db->setQuery($query);
 
                $options = $db->loadObjectList();
 
                // Check for a database error.
                if ($db->getErrorNum()) {
                        JError::raiseWarning(500, $db->getErrorMsg());
                }
 
                return $options;
        }        
        
}