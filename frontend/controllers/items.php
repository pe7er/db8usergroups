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
            // Get the current order by column
            $orderby = $this->getThisModel()->getState('filter_order', '');
            // If it's not one of the allowed columns, force it to be the "ordering" column
          /*  if (!in_array($orderby, array('db8usergroups_item_id', 'ordering', 'title', 'due'))) {
                $orderby = 'ordering';
            }*/
            // Apply ordering and filter only the enabled items
            $this->getThisModel()
                    ->filter_order($orderby)
                    ->enabled(1);
        }
        return $result;
    }

    /**
     * This runs before the browse() method. Return false to prevent executing
     * the method.
     * 
     * @return bool
     */
    public function tonBeforeBrowse() {
        $result = parent::onBeforeBrowse();
        if ($result) {

            $this->getThisModel()
                    ->filter_order('title')
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
