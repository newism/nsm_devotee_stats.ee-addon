<?php

/**
 * Config file for NSM Devot:ee Stats
 *
 * @package			NsmDevoteeStats
 * @version			0.0.1
 * @author			Leevi Graham <http://leevigraham.com>
 * @author			Iain Saxon <http://newism.com.au>
 * @copyright 		Copyright (c) 2007-2012 Newism <http://newism.com.au>
 * @license 		Commercial - please see LICENSE file included with this distribution
 * @link			http://ee-garage.com/nsm-devotee-stats
 */

if(!defined('NSM_DEVOTEE_STATS_VERSION')) {
	define('NSM_DEVOTEE_STATS_VERSION', '0.0.1');
	define('NSM_DEVOTEE_STATS_NAME', 'NSM Devot:ee Stats');
	define('NSM_DEVOTEE_STATS_ADDON_ID', 'nsm_devotee_stats');
}

$config['name'] 	= NSM_DEVOTEE_STATS_NAME;
$config["version"] 	= NSM_DEVOTEE_STATS_VERSION;

$config['nsm_addon_updater']['versions_xml'] = 'http://ee-garage.com/nsm-devotee-stats/release-notes/feed';

$config['api_key'] = "";
$config['secret_key'] = "";
