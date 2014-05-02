<?php

/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

/**
 * Locations list controller class.
 */
class Db8usergroupsControllerItem extends FOFController {
    
    /**
     * Get latitute and longitude via Google Maps API
     * @return void
     */
    public function mapitems() {

        $item_ids = JRequest::getVar('cid', array(), 'post', 'array');

        $model = parent::getModel($name = 'Items', $prefix = 'Db8usergroupsModel', $config = array('ignore_request' => true));
        if (!$model->getCoordinates($item_ids)) {
            echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
        }

        $msg = JText::_('COM_DB8USERGROUPS_ITEMS_MAPPED');
        $this->setRedirect('index.php?option=com_db8usergroups&view=items', $msg, '');
    }

}
