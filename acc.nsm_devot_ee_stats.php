<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require PATH_THIRD.'nsm_devot_ee_stats/config.php';

/**
 * NSM Devot:ee Stats Accessory
 *
 * @package			NsmDevoteeStats
 * @version			0.0.1
 * @author			Leevi Graham <http://leevigraham.com> - Technical Director, Newism
 * @copyright 		Copyright (c) 2007-2010 Newism <http://newism.com.au>
 * @license 		Commercial - please see LICENSE file included with this distribution
 * @link			http://ee-garage.com/nsm-devot-ee-stats
 * @see				http://expressionengine.com/public_beta/docs/development/accessories.html
 */

class Nsm_devot_ee_stats_acc 
{
	public $id				= NSM_DEVOT_EE_STATS_ADDON_ID;
	public $version			= NSM_DEVOT_EE_STATS_VERSION;
	public $name			= NSM_DEVOT_EE_STATS_NAME;
	public $description		= 'Example accessory for NSM Devot:ee Stats.';
	public $sections		= array();

	function set_sections() {
		$this->id .= "_acc";
		$this->sections['Title'] = "Content";
	}
}