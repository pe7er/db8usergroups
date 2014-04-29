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
$this->loadHelper('item');
?><style type="text/css">#map {
    width: auto;
    height: 450px;
    border: solid 1pt #b2b2b2;
}</style>
<script type="text/javascript">
    function initialize() {
        var center = new google.maps.LatLng(35, 0);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 2,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var markers = [];
<?php
foreach ($this->items as $item) :
    //$title = str_replace("'", "&apos;","<strong>".$item->title."</strong><br/>".$item->city."</br>".$item->country);
    echo "var latLng = new google.maps.LatLng(" . $item->latitude . "," . $item->longitude . ");";
    echo "var marker = new google.maps.Marker({
                position: latLng,
                draggable: true,
                icon: '" . JURI::base() . "components/com_db8usergroups/assets/images/joomla.png',
                title: '" . str_replace("'", "&apos;", $item->title) . "',
                content: 'test',
                clickable: true                
                });";
    echo "markers.push(marker);";
    ?>
<?php endforeach ?>
        var markerCluster = new MarkerClusterer(map, markers);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>


<div class="conference">
    <div class="row-fluid">
        <h1><?php echo JText::_('COM_DB8USERGROUPS_TITLE') ?></h1>
    </div>

    
    <div class="span12">
        <div id="map"></div>
    </div>
    <br/>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>User Group Name</th>
                    <th>Organisation</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($this->items)) foreach ($this->items as $item): 
                $item->category = Db8usergroupsHelperItem::category($item->catid);
                ?>
                <tr>
                    <td><a href="<?php echo JRoute::_('index.php?option=com_db8usergroups&view=item&id=' . $item->db8usergroups_item_id) ?>" class="thumbnail">
                            <?php /*if ($item->photo): ?>
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


    </div>
</div>