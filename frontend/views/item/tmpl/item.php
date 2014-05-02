<?php
/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

//$document = JFactory::getDocument();
//$document->addScript('http://maps.google.com/maps/api/js?sensor=false');
//$document->addScript('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js');
//<link rel="stylesheet" href="http://i.icomoon.io/public/temp/6fa5f90689/UntitledProject1/style.css">
//<span class="icon-mail"></span> 

// Get a db connection.

$this->loadHelper('item');
$this->item->category = Db8usergroupsHelperItem::category($this->item->catid);
?>

<div class="row">
    <div class="col-md-4">
        <p><img src="<?php echo $this->item->photo; ?>" alt="<?php echo $this->item->name; ?>" class="img-thumbnail" height="170px" width="146px"></p>
    </div>
    <div class="col-md-4">
        <h2>
            <?php echo $this->item->title; ?>
        </h2>
        <p>
            <?php echo $this->item->category; ?>
            <?php if ($this->item->usergroupemail) { ?>        
            <div>                
                email: <a target="_blank" href="mailto:<?php echo $this->item->usergroupemail; ?>"><?php echo $this->item->usergroupemail; ?></a>
            </div>
        <?php } ?>     
        <?php if ($this->item->phone) { ?>        
            <div>
                <span class="icon-phone"></span> <?php echo $this->item->phone; ?>
            </div>
        <?php } ?>     
        <?php if ($this->item->usergroupwebsite) { ?>        
            <div>
                <a target="_blank" href="http://<?php echo $this->item->website; ?>">
                    <span class="icon-earth"></span> <?php echo $this->item->website; ?></a>
            </div>
        <?php } ?>     
        <?php if ($this->item->googleplus) { ?>        
            <div>
                <a target="_blank" href="http://plus.google.com/<?php echo $this->item->googleplus ?>">
                    <span class="icon-googleplus"></span> <?php echo $this->item->title ?></a>
            </div>
        <?php } ?>     
        <?php if ($this->item->facebook) { ?>        
            <div>
                <a target="_blank" href="http://facebook.com/<?php echo $this->item->facebook ?>">
                    <span class="icon-facebook"></span> <?php echo $this->item->facebook ?></a>
            </div>
        <?php } ?>     
        <?php if ($this->item->twitter) { ?>        
            <div>
                <a target="_blank" href="http://twitter.com/<?php echo $this->item->twitter ?>">
                    <span class="icon-twitter"></span> <?php echo $this->item->twitter ?></a>
            </div>
        <?php } ?>     
        <?php if ($this->item->linkedin) { ?>
            <div>
                <a target="_blank" href="http://www.linkedin.com/in/<?php echo $this->item->linkedin ?>">
                    <span class="icon-linkedin"></span> <?php echo $this->item->linkedin ?>
                </a>
            </div>
        <?php } ?>     
        </p>
    </div>
    <div class="col-md-4"><h2><?php echo $this->item->description; ?></h2>
        <p>
            <div>
                <?php echo $this->item->title; ?>
            </div>
            <div> 
                <?php echo $this->item->address; ?>
            </div>
            <div>
                <?php echo $this->item->postcode; ?> <?php echo $this->item->city; ?>
            </div>
            <div>
                <?php
                if ($this->item->region) {
                    echo $this->item->region . "<br/>";
                }
                ?>
            </div>
            <div>
                <?php echo $this->item->country; ?>
            </div>
</p>
</div>
</div>
<input type="button" value="Back" onclick="window.history.back()" />