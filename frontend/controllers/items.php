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
            
            
            
            $yourlocation = stripslashes($this->getThisModel()->getState('yourlocation', ''));
            if(!empty($yourlocation)){
                $whereurl = urlencode($yourlocation);
                $url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=$whereurl";
                //die($url);
                $json = file_get_contents($url); // get the data from Google Maps API
                $location = json_decode($json, true); // convert it from JSON to php array
                $latitude = $location['results'][0]['geometry']['location']['lat'];
                $longitude = $location['results'][0]['geometry']['location']['lng'];
            }

            $distance = stripslashes($this->getThisModel()->getState('filter_distance', ''));
            if($distance > 0){
                //http://our-knowledge-base.blogspot.nl/2012/04/how-to-search-within-defined-radius.html
                // Find Max - Min Lat / Long for Radius and zero point and query  
                $lat_range = $distance/69.172;  
                $lon_range = abs($distance/(cos($latitude) * 69.172));  
                $min_lat = number_format($latitude - $lat_range, "4", ".", "");  
                $max_lat = number_format($latitude + $lat_range, "4", ".", "");  
                $min_lon = number_format($longitude - $lon_range, "4", ".", "");  
                $max_lon = number_format($longitude + $lon_range, "4", ".", "");  
                $radiussearch = "latitude BETWEEN '".$min_lat."' AND '".$max_lat."' AND  longitude BETWEEN '".$min_lon."' AND '".$max_lon."' ";  
            }

            // If it's not one of the allowed columns, force it to be the "ordering" column
          /*  if (!in_array($orderby, array('db8usergroups_item_id', 'ordering', 'title', 'due'))) {
                $orderby = 'ordering';
            }*/
            // Apply ordering and filter only the enabled items
            $this->getThisModel()
                    ->filter_order($orderby)
                  //  ->where($radiussearch)
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
