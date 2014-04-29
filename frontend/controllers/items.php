<?php

/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

Class Db8usergroupsControllerItems extends FOFController {

    /**
     * This runs before the browse() method. Return false to prevent executing
     * the method.
     * 
     * @return bool
     */
    public function onBeforeBrowse() {
        $result = parent::onBeforeBrowse();
        if ($result) {

            $this->getThisModel()
                    ->filter_order('usergroupname')
                    ->filter_order('catid')
                    ->enabled(1);
        }

        // Fetch page parameters
        $params = JFactory::getApplication()->getPageParameters('com_db8usergroups');

        // Push page parameters
        $this->getThisView()->assign('pageparams', $params);

        return $result;
    }

}
