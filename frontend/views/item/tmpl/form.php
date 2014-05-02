<?php
/**
 * @package     db8usergroups
 * @author	Peter Martin
 * @copyright   Copyright (C) 2014 Peter Martin / db8.nl
 * @license     GNU General Public License version 2 or later
 */
defined('_JEXEC') or die();

$itemId = FOFInput::getInt('Itemid', 0, $this->input);
if ($itemId != 0) {
    $actionURL = 'index.php?Itemid=' . $itemId;
} else {
    $actionURL = 'index.php';
}
$editor = JFactory::getEditor();
?>

<div class="usergroups">
    <form name="adminForm" class="form form-horizontal" action="<?php echo $actionURL ?>" method="post" enctype="multipart/form-data">
        <div class="row-fluid">
            <h1 class="pull-left"><?php echo JText::_('COM_DB8USERGROUPS_ADD_USERGROUP') ?></h1>
            <div class="btn-toolbar pull-right">
                <div id="toolbar-cancel" class="btn-group">
                    <a class="btn btn-small" href="<?php echo JRoute::_('index.php?option=com_db8usergroups&view=items') ?>">
                        <span class="icon-cancel"></span> <?php echo JText::_('JCANCEL') ?>
                    </a>
                </div>
                <div id="toolbar-apply" class="btn-group">
                    <button class="btn btn-small btn-success" type="submit">
                        <span class="icon-pencil"></span> <?php echo JText::_('JSAVE') ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="well well-small">
            <!-- Start row -->
            <div class="row-fluid">
                <!-- Start left -->
                <div class="span12">
                    <div class="control-group">
                        <label for="title" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_TITLE') ?>
                        </label>
                        <div class="controls">
                            <input name="title"
                                   type="text" 
                                   id="title" 
                                   class="span" 
                                   value="<?php echo $this->item->title; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="location" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_LOCATION') ?>
                        </label>
                        <div class="controls">
                            <input name="location"
                                   type="text" 
                                   id="location" 
                                   class="span" 
                                   value="<?php echo $this->item->location; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="address" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_ADDRESS') ?>
                        </label>
                        <div class="controls">
                            <input name="address"
                                   type="text" 
                                   id="address" 
                                   class="span" 
                                   value="<?php echo $this->item->address; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="postcode" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_POSTCODE') ?>
                        </label>
                        <div class="controls">
                            <input name="postcode"
                                   type="text" 
                                   id="postcode" 
                                   class="span" 
                                   value="<?php echo $this->item->postcode; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="city" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CITY') ?>
                        </label>
                        <div class="controls">
                            <input name="city"
                                   type="text" 
                                   id="city" 
                                   class="span" 
                                   value="<?php echo $this->item->city; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="region" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_REGION') ?>
                        </label>
                        <div class="controls">
                            <input name="region"
                                   type="text" 
                                   id="region" 
                                   class="span" 
                                   value="<?php echo $this->item->region; ?>" 
                                   />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="country" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_COUNTRY') ?>
                        </label>
                        <div class="controls">
                            <input name="country"
                                   type="text" 
                                   id="country" 
                                   class="span" 
                                   value="<?php echo $this->item->country; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="category" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CATEGORY') ?>
                        </label>
                        <div class="controls">
                            <input name="catid"
                                   type="category"
                                   extension="com_db8usergroups" 
                                   label="JCATEGORY" 
                                   id="category" 
                                   class="span" 
                                   value="<?php echo $this->item->catid; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <hr/>

                    <?php if (!JFactory::getUser()->id): ?>
                        <div class="control-group">
                            <label for="email" class="control-label">
                                <?php echo JText::_('JGLOBAL_EMAIL') ?>
                            </label>
                            <div class="controls">
                                <input type="text" name="usergroupemail" id="email" class="span" placeholder="mail@website.com" value="<?php echo $this->item->usergroupemail; ?>" required="required"/>
                                <span class="help-block"><?php echo JText::_('COM_DB8USERGROUPS_FIELD_EMAIL_DESC') ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <hr/>
                    <div class="control-group">
                        <label for="twitter" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_TWITTER') ?>
                        </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">@</span>
                                <input type="text" name="twitter" id="twitter" class="span" placeholder="username" value="<?php echo $this->item->twitter ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="facebook" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_FACEBOOK') ?>
                        </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">http://www.facebook.com/</span>
                                <input type="text" name="facebook" id="facebook" class="span" placeholder="username" value="<?php echo $this->item->facebook ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="googleplus" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_GOOGLEPLUS') ?>
                        </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">http://plus.google.com/</span>
                                <input type="text" name="googleplus" id="googleplus" class="span" placeholder="username" value="<?php echo $this->item->googleplus ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="googleplus" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_LINKEDIN') ?>
                        </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">http://www.linkedin.com/in/</span>
                                <input type="text" name="linkedin" id="linkedin" class="span" placeholder="username" value="<?php echo $this->item->linkedin ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="website" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_WEBSITE') ?>
                        </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">http://</span>
                                <input type="text" name="website" id="website" class="span" placeholder="www.website.com" value="<?php echo $this->item->website ?>"/>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="control-group">
                        <label for="bio" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_DESCRIPTION') ?>
                        </label>
                        <div class="controls">
                            <?php echo $editor->display('description', $this->item->description, '100%', '300', '10', '10', false); ?>
                        </div>
                    </div>
                    <hr/>
                    <div class="control-group">
                        <label for="contactname" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CONTACTNAME') ?>
                        </label>
                        <div class="controls">
                            <input name="contactname"
                                   type="text" 
                                   id="contactname" 
                                   class="span" 
                                   value="<?php echo $this->item->contactname; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="contactphone" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CONTACTPHONE') ?>
                        </label>
                        <div class="controls">
                            <input name="contactphone"
                                   type="text" 
                                   id="contactphone" 
                                   class="span" 
                                   value="<?php echo $this->item->contactphone; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="contactemail" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CONTACTEMAIL') ?>
                        </label>
                        <div class="controls">
                            <input name="contactemail"
                                   type="text" 
                                   id="contactemail" 
                                   class="span" 
                                   value="<?php echo $this->item->contactemail; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="control-group">
                        <label for="contactname2" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CONTACTNAME2') ?>
                        </label>
                        <div class="controls">
                            <input name="contactname2"
                                   type="text" 
                                   id="contactname2" 
                                   class="span" 
                                   value="<?php echo $this->item->contactname2; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="contactphone2" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CONTACTPHONE2') ?>
                        </label>
                        <div class="controls">
                            <input name="contactphone2"
                                   type="text" 
                                   id="contactphone2" 
                                   class="span" 
                                   value="<?php echo $this->item->contactphone2; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="contactemail2" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_CONTACTEMAIL2') ?>
                        </label>
                        <div class="controls">
                            <input name="contactemail2"
                                   type="text" 
                                   id="contactemail2" 
                                   class="span" 
                                   value="<?php echo $this->item->contactemail2; ?>" 
                                   required="required"/>
                        </div>
                    </div>
                    <hr/>
                    <hr/>
                    <div class="control-group">
                        <label for="image" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_LOGO') ?>
                        </label>
                        <div class="controls">
                            <input type="file" 
                                   name="logo" 
                                   id="image" 
                                   class="span" />
                            <span class="help-block"><?php echo JText::_('COM_DB8USERGROUPS_FIELD_LOGO_DESC') ?></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="image" class="control-label">
                            <?php echo JText::_('COM_DB8USERGROUPS_FIELD_PHOTO') ?>
                        </label>
                        <div class="controls">
                            <input type="file" 
                                   name="photo" 
                                   id="image" 
                                   class="span" />
                            <span class="help-block"><?php echo JText::_('COM_DB8USERGROUPS_FIELD_PHOTO_DESC') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="option" value="com_db8usergroups" />
        <input type="hidden" name="view" value="item" />
        <input type="hidden" name="task" value="save" />
        <input type="hidden" name="db8usergroups_item_id" value="<?php echo $this->item->db8usergroups_item_id ?>" />
        <input type="hidden" name="Itemid" value="<?php echo $itemId ?>" />
        <input type="hidden" name="<?php echo JFactory::getSession()->getFormToken(); ?>" value="1" />
        <input type="hidden" name="user_id" value="<?php echo JFactory::getUser()->id ?>" />
        <input type="hidden" name="enabled" value="<?php echo($this->item->enabled); ?>" />
    </form>
</div>