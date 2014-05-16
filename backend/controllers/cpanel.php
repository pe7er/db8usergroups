<?php

/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

class Db8usergroupsControllerCpanel extends FOFController

{
	public function execute($task)
	{
		parent::execute('browse');
	}
}