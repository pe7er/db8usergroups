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
	public static function categories($category)
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
}