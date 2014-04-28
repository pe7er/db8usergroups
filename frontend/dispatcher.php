<?php

/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

class Db8usergroupsDispatcher extends FOFDispatcher {

    public function __construct($config = array()) {
        $this->defaultView = 'items';

        parent::__construct($config);
    }

    public function onBeforeDispatch() {
        $result = parent::onBeforeDispatch();

        if ($result) {
            $doc = JFactory::getDocument();
            //$doc->addStyleSheet(Jcomponent::_'assets/css/frontend.css');
        }

        return $result;
    }
    
}