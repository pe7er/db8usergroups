<?php
/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

// Get the Itemid
$itemId = FOFInput::getInt('Itemid', 0, $this->input);
if ($itemId != 0) {
    $actionURL = 'index.php?Itemid=' . $itemId;
} else {
    $actionURL = 'index.php';
}
$document = JFactory::getDocument();
$document->addScript('http://maps.google.com/maps/api/js?sensor=false');
$document->addScript('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js');
$document->addStyleSheet(JURI::base() . "components/com_db8usergroups/assets/frontend.css");
$this->loadHelper('item');

// Create some shortcuts.
//$params = &$this->item->params;
//$n = count($this->items);
//$listOrder	= $this->escape($this->state->get('list.ordering'));
//$listDirn	= $this->escape($this->state->get('list.direction'));
//Get Filter options
//require_once '/var/www/development/components/com_db8usergroups/helpers/categories.php';

JHtml::_('behavior.framework');

require_once JPATH_COMPONENT . '/helpers/categories.php';
$categories = Db8usergroupsHelperCategories::getCategories();

// to do:
// 1. auto center + auto zoom
// http://stackoverflow.com/questions/15719951/google-maps-api-v3-auto-center-map-with-multiple-markers
// 2. filter columns
// 3. radius search
// 4. configure category select, map icon,

?>
<script type="text/javascript">
    function initialize() {
        var center = new google.maps.LatLng(15, 0);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 1,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var markers = [];
<?php
foreach ($this->items as $item) :

    if (!empty($item->latitude) AND !empty($item->longitude)) {
        //$title = str_replace("'", "&apos;","<strong>".$item->title."</strong><br/>".$item->city."</br>".$item->country);
        echo "var latLng = new google.maps.LatLng(" . $item->latitude . "," . $item->longitude . ");";
        echo "var marker = new google.maps.Marker({
                    position: latLng,
                    draggable: true,
                    icon: '" . JURI::base() . "components/com_db8usergroups/assets/images/penguin.png',
                    title: '" . str_replace("'", "&apos;", $item->title) . "',
                    content: 'test',
                    clickable: true                
                    });";
        echo "markers.push(marker);";
    }
    ?>
<?php endforeach ?>
        var markerCluster = new MarkerClusterer(map, markers);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div class="usergroups">
    <div class="row-fluid">
        <h1><?php echo JText::_('COM_DB8USERGROUPS_TITLE') ?></h1>
    </div>


    <div class="span12">
        <div id="map"></div>
    </div>
    <br/>
    <?php // <?php echo JHtml::_('select.genericlist', $this->months, 'filter_month[]', 'class="input-medium" multiple="true" size="12"', 'value', 'text', $this->getModel()->getState('filter_month', ''), 'filter_month', true); 
    //*/?>
<form id="adminForm" method="post" name="adminForm">
    <?php echo JText::_('COM_DB8USERGROUPS_CATEGORIES'); ?>:
    <select name="filter_category" class="inputbox" onchange="this.form.submit()">
        <option value="">
            <?php echo JText::_('COM_DB8USERGROUPS_SELECT_CATEGORY'); ?>
        </option>
        <?php echo JHtml::_('select.options', $categories, 'value', 'text', $this->getModel()->getState('filter_category', '')); ?>
    </select>
    <button type="submit">
        <?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>
    </button>

    <?php 
    // define distance dropdown box -> 2do: make it paramater
    $distances = array(5,10,20,30,50,100,150,200);
    ?>
    <br/><?php echo JText::_('COM_DB8USERGROUPS_YOURLOCATION'); ?>
    <input id="yourlocation" type="text" name="yourlocation" value="<?php echo $this->getModel()->getState('yourlocation', '');?>" onchange="this.form.submit()" class="input" size="40" placeholder="Your address">
    <br/>
    <?php echo JText::_('COM_DB8USERGROUPS_MAXDISTANCE'); ?>
    <select name="filter_distance" class="inputbox" onchange="this.form.submit()">
        <option value="">
            <?php echo JText::_('COM_DB8USERGROUPS_SELECT_DISTANCE'); ?>
        </option>
        <?php echo JHtml::_('select.options', $distances, 'value', 'text', $this->getModel()->getState('filter_distance', '')); ?>
    </select>    
    
    
    <br/>[todo: Free filter Input Box]
    <br/>[todo: List limit dropdown]
    <br/>[todo: address input box + range selection]
    
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <?php echo JHTML::_('grid.sort', 'COM_DB8USERGROUPS_NAME', 'title', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
                    </th>
                    <th>
                        <?php echo JHTML::_('grid.sort', 'COM_DB8USERGROUPS_LOCATION', 'city', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
                    </th>
                    <th>
                        <?php echo JHTML::_('grid.sort', 'COM_DB8USERGROUPS_CATEGORY', 'category', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($this->items))
                    foreach ($this->items as $item):
                        $item->category = Db8usergroupsHelperItem::category($item->catid);
                        ?>
                        <tr>
                            <td><a href="<?php echo JRoute::_('index.php?option=com_db8usergroups&view=item&id=' . $item->db8usergroups_item_id) ?>" class="thumbnail">
                                    <?php /* if ($item->photo): ?>
                                      <img src="<?php echo $item->photo; ?>">
                                      <?php else: ?>
                                      <img src="http://placehold.it/200x200">
                                      <?php endif; */ ?>
                                </a>
                            </td>
                            <td><a href="<?php echo JRoute::_('index.php?option=com_db8usergroups&view=item&id=' . $item->db8usergroups_item_id) ?>">
                                    <?php echo $this->escape($item->title); ?>
                                </a>
                            </td>
                            <td><?php echo $this->escape($item->address); ?><br/>
                                <?php echo $this->escape($item->city); ?> <?php echo $this->escape($item->country); ?></td>
                            <td><?php echo $this->escape($item->category); ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
</form>    
    </div>
</div>