<?php

/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

class Db8usergroupsModelItems extends FOFmodel {

    protected $_savestate = 1;

    
    	protected function loadFormData()
	{
                JFactory::getApplication()->setUserState('com_db8usergroups.add.item.data', '');
            
		if (empty($this->_formData))
		{
			return array();
		}
		else
		{
			return $this->_formData;
		}
	}
    
    
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
            if (!in_array($orderby, array('db8usergroups_item_id', 'ordering', 'title', 'due'))) {
                $orderby = 'ordering';
            }
            // Apply ordering and filter only the enabled items
            $this->getThisModel()
                    ->filter_order($orderby)
                    ->enabled(1);
        }
        return $result;
    }

    private function getFilterValues() {
        $enabled = $this->getState('enabled', '', 'cmd');

        return (object) array(
                    'category' => $this->getState('filter_category', null, 'int'),
                    'id' => $this->getState('id', null, 'int'),
                    //'ordering' => $this->getState('Joomla.tableOrdering', null, 'cmd'),
                    'enabled' => $enabled,
        );
    }

    protected function _buildQueryColumns($query) {
        $db = $this->getDbo();
        $state = $this->getFilterValues();

        $query->select(array(
            $db->qn('tbl') . '.*',
            $db->qn('cat') . '.' . $db->qn('title') . ' AS ' . $db->qn('category'),
        ));

        $order = $this->getState('Joomla.tableOrdering', 'db8usergroups_item_id', 'cmd');
        if (!in_array($order, array_keys($this->getTable()->getData()))) {
            $order = 'db8usergroups_item_id';
        }
        $dir = $this->getState('filter_order_Dir', 'DESC', 'cmd');
        $query->order($order . ' ' . $dir);
    }

    protected function _buildQueryJoins($query) {
        $db = $this->getDbo();
        $query->join('LEFT OUTER', $db->qn('#__categories') . ' AS ' . $db->qn('cat') . ' ON ' .
                $db->qn('cat') . '.' . $db->qn('id') . ' = ' .
                $db->qn('tbl') . '.' . $db->qn('catid'))
        ;
    }

    protected function getCategoryChildren($catid) {

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('node.id')
                ->from('#__categories AS node, #__categories AS parent')
                ->where('node.lft BETWEEN parent.lft AND parent.rgt')
                ->where('parent.id = ' . $catid)
                ->order('node.lft');

        $db->setQuery($query);
        $catids = $db->loadColumn();

        return $catids;
    }

    protected function _buildQueryWhere($query) {
        $db = $this->getDbo();
        $state = $this->getFilterValues();

        if (is_numeric($state->enabled)) {
            $query->where(
                    $db->qn('tbl') . '.' . $db->qn('enabled') . ' = ' .
                    $db->q($state->enabled)
            );
        }

        // Retrieve all items for category and its child categories
        if (is_numeric($state->category) && ($state->category > 0)) {
            $catids = $this->getCategoryChildren($state->category);
            if (array($catids)) {
                $query->where($db->qn('tbl') . '.' . $db->qn('catid') . ' IN (' . implode(",", $db->q($catids)) . ')');
            } else {
                $query->where($db->qn('tbl') . '.' . $db->qn('catid') . ' = ' . $db->q($catids));
            }
        }

        if (is_numeric($state->id) && ($state->id > 0)) {
            $query->where(
                    $db->qn('tbl') . '.' . $db->qn('usergroup_item_id') . ' = ' .
                    $db->q($state->id)
            );
        }
    }

    public function buildQuery($overrideLimits = false) {
        $db = $this->getDbo();
        $query = FOFQueryAbstract::getNew($db)
                ->from($db->quoteName('#__db8usergroups_items') . ' AS ' . $db->qn('tbl'));

        $this->_buildQueryColumns($query);
        $this->_buildQueryJoins($query);
        $this->_buildQueryWhere($query);
        //$this->_buildQueryGroup($query);

        return $query;
    }

    /* */

    public function onAfterGetItem(&$record) {

        $session = JFactory::getSession();
        $hash = $this->getHash() . 'savedata';
        $data = unserialize($session->get($hash));
    }

    public function &getItemList($overrideLimits = false, $group = '') {
        if (empty($this->list)) {
            $query = $this->buildQuery($overrideLimits);

            // override for front-end: don't use list limit from parameters but show all.
            if (FOFPlatform::getInstance()->isFrontend()) {
                $this->list = $this->_getList((string) $query, 0, 0, $group);
            } else {
                if (!$overrideLimits) {
                    $limitstart = $this->getState('limitstart');
                    $limit = $this->getState('limit');
                    $this->list = $this->_getList((string) $query, $limitstart, $limit, $group);
                } else {
                    $this->list = $this->_getList((string) $query, 0, 0, $group);
                }
            }
        }
        return $this->list;
    }

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to lookup coordinates at Google Maps for item(s)
     */
    function getCoordinates($item_ids = array()) {

        $db = $this->getDbo();

        foreach ($item_ids as $item_id) {
            $query = $db->getQuery(true)
                    ->select('location, address, postcode, city, region, country, latitude, longitude')
                    ->from($db->quoteName('#__db8usergroups_items'))
                    ->where($db->quoteName('db8usergroups_item_id') . ' = ' . $db->quote($item_id));

            $db->setQuery($query);
            $item = $db->loadObject();

//Retrieve latitude + longitude when both empty & store in database
//if ($item->latitude == 0 && $item->longitude == 0) {
// retrieve coordinates from Google via API
            $where = stripslashes($item->location . ", " . $item->address . ", " . $item->postcode . ", " . $item->city . ", " . $item->region . ", " . $item->country);
            $whereurl = urlencode($where);
            $url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=$whereurl";
            $json = file_get_contents($url); // get the data from Google Maps API
            $result = json_decode($json, true); // convert it from JSON to php array
            $latitude = $result['results'][0]['geometry']['location']['lat'];
            $longitude = $result['results'][0]['geometry']['location']['lng'];


            $query = $db->getQuery(true)
                    ->update($db->quoteName('#__db8usergroups_items'))
                    ->set($db->quoteName('latitude') . ' = ' . $db->quote($latitude))
                    ->set($db->quoteName('longitude') . ' = ' . $db->quote($longitude))
                    ->where($db->quoteName('db8usergroups_item_id') . ' = ' . $db->quote($item_id));

            $db->setQuery($query);
            $db->query();
// Check for a database error.
            if ($db->getErrorNum()) {
                JError::raiseWarning(500, $db->getErrorMsg());
                return false;
// }
            }
        }

        return true;
    }

}
