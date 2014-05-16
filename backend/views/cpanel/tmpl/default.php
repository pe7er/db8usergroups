<?php
/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . "components/com_db8usergroups/assets/backend.css");

JHtml::_('behavior.framework');
JHtml::_('behavior.modal');

$option = 'com_db8usergroups';
?>

<div id="cpanel" class="span12">
    <div class="icon">
        <a href="index.php?option=com_db8usergroups&view=items">
            <img src="<?php echo JURI::base(); ?>components/com_db8usergroups/assets/images/items-48.png" 
                 border="0" alt="<?php echo JText::_('COM_DB8USERGROUPS_TITLE_ITEMS') ?>"/>
            <span>
                <?php echo JText::_('COM_DB8USERGROUPS_TITLE_ITEMS') ?><br/>
            </span>
        </a>
    </div>
    <div class="icon">
        <a href="index.php?option=com_categories&extension=com_db8usergroups">
            <img src="<?php echo JURI::base(); ?>components/com_db8usergroups/assets/images/categories-48.png" 
                 border="0" alt="<?php echo JText::_('COM_DB8USERGROUPS_TITLE_CATEGORIES') ?>"/>
            <span>
                <?php echo JText::_('COM_DB8USERGROUPS_TITLE_CATEGORIES') ?><br/>
            </span>
        </a>
    </div>
    <div class="icon">
        <a href="index.php?option=com_db8usergroups&view=items">
            <img src="<?php echo JURI::base(); ?>components/com_db8usergroups/assets/images/todo-48.png" 
                 border="0" alt="<?php echo JText::_('COM_DB8USERGROUPS_TITLE_ITEMS') ?>"/>
            <span>
                [2do: New Submissions]<br/>
            </span>
        </a>
    </div>

</div>
<div class="row-fluid footer">
    <div class="span12">
        <p style="height: 6em">
            <br/>Copyright ©2006 - 2014 by Peter Martin, <a href="http://www.db8.nl" target="_blank">db8.nl</a>. All Rights Reserved.
            <br/>Code, bug reports & issue requests: <a href="https://github.com/pe7er/db8usergroups" target="_blank">https://github.com/pe7er/db8usergroups</a>
            <br/><a href="http://kde-look.org/content/show.php/?content=45576" target="_blank">Crystal Diamond Icons</a> by Paolo Campitelli.
            <br/><br/>License: GNU General Public License, version 2 or later version.	
            <br/>If you use db8 User Groups, please post a review and rating at the <a href="http://extensions.joomla.org/" target="_blank">Joomla! Extensions Directory</a>. 
        </p>
    </div>
</div>