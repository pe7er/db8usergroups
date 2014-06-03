<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Db8usergroupsModelItems extends FOFModel {

    public function buildQuery($overrideLimits = false) {
        $query=parent::buildQuery($overrideLimits = false);
        
        //$query->where("title LIKE '%New%'");
          /*      
        if(){
            $orderCol = $app->getUserStateFromRequest('com_db8usergroups.items.' . $itemid . '.filter_order', 'filter_order', '', 'string');
		if (!in_array($orderCol, $this->filter_fields))
		{
			$orderCol = 'a.ordering';
		}
		$this->setState('list.ordering', $orderCol);

		$listOrder = $app->getUserStateFromRequest('com_content.category.list.' . $itemid . '.filter_order_Dir',
			'filter_order_Dir', '', 'cmd');
		if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', '')))
		{
			$listOrder = 'ASC';
		}
		$this->setState('list.direction', $listOrder);
            */
            
            
            //$query->order($column." ".$ascdesc);
        //}
            
       
        
        
        return $query;
    }

}
