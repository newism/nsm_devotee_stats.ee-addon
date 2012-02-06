<?php

/**
 * Config file for NSM Devot:ee Stats
 *
 * @package			NsmDevoteeStats
 * @version			0.0.1
 * @author			Leevi Graham <http://leevigraham.com>
 * @copyright 		Copyright (c) 2007-2010 Newism <http://newism.com.au>
 * @license 		Commercial - please see LICENSE file included with this distribution
 * @link			http://expressionengine-addons.com/nsm-example-addon
 */

if(!defined('NSM_DEVOT_EE_STATS_VERSION')) {
	define('NSM_DEVOT_EE_STATS_VERSION', '0.0.1');
	define('NSM_DEVOT_EE_STATS_NAME', 'NSM Devot:ee Stats');
	define('NSM_DEVOT_EE_STATS_ADDON_ID', 'nsm_devot_ee_stats');
}

$config['name'] 	= NSM_DEVOT_EE_STATS_NAME;
$config["version"] 	= NSM_DEVOT_EE_STATS_VERSION;

$config['nsm_addon_updater']['versions_xml'] = 'http://github.com/newism/nsm.example_addon.ee_addon/raw/master/versions.xml';
