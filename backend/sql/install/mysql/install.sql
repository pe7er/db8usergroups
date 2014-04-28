CREATE TABLE IF NOT EXISTS `#__db8usergroups_items` (
    `db8usergroups_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `usergroupname` varchar(50) NOT NULL,
    `usergroupwebsite` varchar(50) NOT NULL,
    `fullprovisional` tinyint(3) NOT NULL DEFAULT '1',
    `description` MEDIUMTEXT NOT NULL,

    `contactname` varchar(50) NOT NULL,
    `contactphone` varchar(50) NOT NULL,
    `contactemail` varchar(50) NOT NULL,
    `contactname2` varchar(50) NOT NULL,
    `contactphone2` varchar(50) NOT NULL,
    `contactemail2` varchar(50) NOT NULL,

    `twitter` varchar(50) NOT NULL,
    `linkedin` varchar(50) NOT NULL,
    `facebook` varchar(50) NOT NULL,
    `googleplus` varchar(50) NOT NULL,

    `location` varchar(60) NOT NULL,
    `address` varchar(50) NOT NULL,
    `postcode` varchar(12) NOT NULL,
    `city` varchar(50) NOT NULL,
    `region` varchar(50) NOT NULL,
    `country` varchar(50) NOT NULL,
    `latitude` varchar(10) NOT NULL,
    `longitude` varchar(10) NOT NULL,

    `meetinginfo` MEDIUMTEXT NOT NULL,
    `rssfeed` varchar(100) NOT NULL,
    `meetup_apikey` varchar(100) NOT NULL,
    `meetup_groupid` varchar(100) NOT NULL,

    `teamdetails` MEDIUMTEXT NOT NULL,

    `enabled` tinyint(3) NOT NULL DEFAULT '1',
    `ordering` int(11) NOT NULL DEFAULT '0',
    `catid` int(10) unsigned NOT NULL DEFAULT '0',
    `language` char(7) NOT NULL DEFAULT '*',
    `access` int(10) unsigned NOT NULL DEFAULT '0',
    `created_by` bigint(20) NOT NULL DEFAULT '0',
    `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by` bigint(20) NOT NULL DEFAULT '0',
    `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `locked_by` bigint(20) NOT NULL DEFAULT '0',
    `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `hits` int(10) unsigned NOT NULL DEFAULT '0',
    `version` int(10) unsigned NOT NULL DEFAULT '1',
PRIMARY KEY (`db8usergroups_item_id`)
) DEFAULT CHARSET=utf8;