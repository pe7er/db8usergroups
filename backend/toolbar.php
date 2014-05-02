<?php

/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

class Db8usergroupsToolbar extends FOFToolbar {

    public function Db8usergroupsHelperRenderSubmenu($vName) {
        return $this->renderSubmenu($vName);
    }

    public function renderSubmenu($vName = null) {
        if (is_null($vName)) {
            $vName = $this->input->getCmd('view', 'cpanel');
        }
        $this->input->set('view', $vName);

        parent::renderSubmenu();
        $toolbar = FOFToolbar::getAnInstance($this->input->getCmd('option', 'com_db8usergroups'), $this->config);
        $toolbar->appendLink(Jtext::_('COM_DB8USERGROUPS_TITLE_CATEGORIES'), 'index.php?option=com_categories&extension=com_db8usergroups', $vName == 'categories');
    }

    public function onItemsBrowse() {
        parent::onBrowse();

        JToolBarHelper::custom('mapitems', 'copy.png', 'copy_f2.png', 'COM_DB8USERGROUPS_MAPITEM', false);
    }

   /* public function onItemsEdit() {
        parent::onBrowse();

        JToolBarHelper::custom('mapitem', 'copy.png', 'copy_f2.png', 'COM_DB8USERGROUPS_MAPITEM', false);
    }*/

}
