<?php

/**
  @package     db8usergroups
  @author	Peter Martin
  @copyright   Copyright (C) 2014 Peter Martin / db8.nl
  @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

/**
  Helper to display db8 locate component submenus in com_categories
 */
abstract class Db8usergroupsHelper {

    /**
      Configure the Linkbar.
     */
    public static function addSubmenu($vName) {
        // Load FOF
        include_once JPATH_LIBRARIES . '/fof/include.php';

        if (!defined('FOF_INCLUDED')) {
            JError::raiseError('500', 'FOF is not installed');
        }

        if (version_compare(JVERSION, '3.0', 'ge')) {
            $strapper = new FOFRenderJoomla3;
        } else {
            $strapper = new FOFRenderJoomla;
        }

        $strapper->renderCategoryLinkbar('com_db8usergroups');
    }

}
