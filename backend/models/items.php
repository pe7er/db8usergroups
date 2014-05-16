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
            $url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=true&address=$whereurl";
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
