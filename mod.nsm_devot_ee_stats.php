<?php if (! defined('BASEPATH')) die('No direct script access allowed');

require PATH_THIRD.'nsm_devot_ee_stats/config.php';

/**
 * NSM Devot:ee Stats Tag methods
 *
 * @package			NsmDevoteeStats
 * @version			0.0.1
 * @author			Leevi Graham <http://leevigraham.com>
 * @copyright 		Copyright (c) 2007-2010 Newism <http://newism.com.au>
 * @license 		Commercial - please see LICENSE file included with this distribution
 * @link			http://expressionengine-addons.com/nsm-example-addon
 * @see				http://expressionengine.com/public_beta/docs/development/modules.html#control_panel_file
 */

class Nsm_devot_ee_stats {

	private $addon_id = NSM_DEVOT_EE_STATS_ADDON_ID;

	public $test_mode = false;
	
	public $cache_lifetime = 86400;
	
	/**
	 * PHP5 constructor function.
	 *
	 * @access public
	 * @return void
	 **/
	public function __construct() {
		// set the addon id
		$this->addon_id = NSM_DEVOT_EE_STATS_ADDON_ID;
	
		// Create a singleton reference
		$EE =& get_instance();

		// define a constant for the current site_id rather than calling $PREFS->ini() all the time
		if (defined('SITE_ID') == FALSE) {
			define('SITE_ID', $EE->config->item('site_id'));
		}

		// Init the cache
		// If the cache doesn't exist create it
		if (! isset($EE->session->cache[$this->addon_id])) {
			$EE->session->cache[$this->addon_id] = array();
		}

		// Assig the cache to a local class variable
		$this->cache =& $EE->session->cache[$this->addon_id];
	}

	public function fetch()
	{
		$EE =& get_instance();
		// prepare tag params
		$addon_id = $EE->TMPL->fetch_param('addon', false);
		// no addon set?
		if (!$addon_id) {
			return '';
		}
		// get data
		$data = $this->_getAddonData($addon_id);
		// no data?
		if (!$data) {
			return '';
		}
		
		$tmp = array();
		$tmp_count = 0;
		
		// adjust developer data
		$data['developer_name'] = $data['developer']['developer_name'];
		$data['developer_alt'] = $data['developer']['developer_alt'];
		unset($data['developer_links']);
		$data['developer_links_total'] = count($data['developer']['developer_links']);
		$data['developer_links'] = false;
		if ($data['developer_links_total'] > 0) {
			$data['developer_links'] = array();
			for ($i=0, $m=$data['developer_links_total']; $i<$m; $i+=1) {
				$data['developer_links'][$i]['developer_link_site'] = $data['developer']['developer_links'][$i]['site'];
				$data['developer_links'][$i]['developer_link_title'] = $data['developer']['developer_links'][$i]['title'];
				$data['developer_links'][$i]['developer_link_url'] = $data['developer']['developer_links'][$i]['url'];
				$data['developer_links'][$i]['developer_link_count'] = ($i + 1);
			}
		}
		unset($data['developer']);
		
		// adjust category data
		$tmp['categories'] = $data['categories'];
		unset($data['categories']);
		$data['categories_total'] = count($tmp['categories']);
		$data['categories'] = false;
		if ($data['categories_total'] > 0) {
			$data['categories'] = array();
			for ($i=0, $m=$data['categories_total']; $i<$m; $i+=1) {
				$data['categories'][$i]['category'] = $tmp['categories'][$i];
				$data['categories'][$i]['category_count'] = ($i + 1);
			}
		}
		unset($tmp['categories']);
		
		// adjust version support data
		$data['version_support_ee1'] = $data['version_support']['EE1'];
		$data['version_support_ee2'] = $data['version_support']['EE2'];
		unset($data['version_support']);
		
		// adjust compatibility data
		$tmp['compatibility'] = $data['compatibility'];
		unset($data['compatibility']);
		$data['compatibility_total'] = count($tmp['compatibility']);
		$data['compatibility'] = false;
		if ($data['compatibility_total'] > 0) {
			$data['compatibility'] = array();
			$tmp_count = 0;
			foreach ($tmp['compatibility'] as $compatibility_type => $compatibility_value) {
				$data['compatibility'][$tmp_count]['compatibility_type'] = $compatibility_type;
				$data['compatibility'][$tmp_count]['compatibility_value'] = $compatibility_value;
				$data['compatibility'][$tmp_count]['compatibility_count'] = ($tmp_count + 1);
				$tmp_count += 1;
			}
		}
		unset($tmp['compatibility']);
		
		// adjust requirements data
		$tmp['requirements'] = $data['requirements'];
		unset($data['requirements']);
		$data['requirements_total'] = count($tmp['requirements']);
		$data['requirements'] = false;
		if ($data['requirements_total'] > 0) {
			$data['requirements'] = array();
			$tmp_count = 0;
			foreach ($tmp['requirements'] as $requirement_type => $requirement_value) {
				$data['requirements'][$tmp_count]['requirement_type'] = $requirement_type;
				$data['requirements'][$tmp_count]['requirement_value'] = $requirement_value;
				$data['requirements'][$tmp_count]['requirement_count'] = ($tmp_count + 1);
				$tmp_count += 1;
			}
		}
		unset($tmp['requirements']);
		
		// adjust links data
		$tmp['links'] = $data['links'];
		unset($data['links']);
		$data['links_total'] = count($tmp['links']);
		$data['links'] = false;
		if ($data['links_total'] > 0) {
			$data['links'] = array();
			for ($i=0, $m=$data['links_total']; $i<$m; $i+=1) {
				$data['links'][$i]['link_title'] = $tmp['links'][$i]['title'];
				$data['links'][$i]['link_url'] = $tmp['links'][$i]['url'];
				$data['links'][$i]['link_count'] = ($i + 1);
			}
		}
		unset($tmp['links']);
		
		// adjust hooks data
		$tmp['hooks'] = $data['hooks'];
		unset($data['hooks']);
		$data['hooks_total'] = count($tmp['hooks']);
		$data['hooks'] = false;
		if ($data['hooks_total'] > 0) {
			$data['hooks'] = array();
			for ($i=0, $m=$data['hooks_total']; $i<$m; $i+=1) {
				$data['hooks'][$i]['hook'] = $tmp['hooks'][$i];
				$data['hooks'][$i]['hook_count'] = ($i + 1);
			}
		}
		unset($tmp['hooks']);
		
		// adjust reviews data
		$tmp['reviews'] = $data['reviews'];
		unset($data['reviews']);
		$data['reviews_total'] = count($tmp['reviews']);
		$data['reviews'] = false;
		if ($data['reviews_total'] > 0) {
			$data['reviews'] = array();
			for ($i=0, $m=$data['reviews_total']; $i<$m; $i+=1) {
				$data['reviews'][$i]['review_author_name'] = $tmp['reviews'][$i]['author_name'];
				$data['reviews'][$i]['review_author_url'] = $tmp['reviews'][$i]['author_url'];
				$data['reviews'][$i]['review_author_photo'] = $tmp['reviews'][$i]['author_photo'];
				$data['reviews'][$i]['review_date'] = $tmp['reviews'][$i]['date'];
				$data['reviews'][$i]['review'] = $tmp['reviews'][$i]['review'];
				$data['reviews'][$i]['review_count'] = ($i + 1);
			}
		}
		unset($tmp['reviews']);
		
		// clean up
		unset($tmp, $tmp_count);
		
		$tagdata = $EE->TMPL->tagdata;
		$tagdata = $EE->functions->prep_conditionals($tagdata, $data);
		$tagdata = $EE->TMPL->parse_variables_row($tagdata, $data);
		
		return $tagdata;
	}
	
	private function _getAddonData($addon_id)
	{
		$data = false;
		$url = 'http://devot-ee.com/add-ons/data-json/' . $addon_id;
		// is test mode set or cache expired?
		if ($this->test_mode || ! $json = $this->_readCache(md5($url))) {
			$json = $this->_doCurl($url);
		}
		$data = json_decode($json, true);
		return $data;
	}
	
	private function _doCurl($url)
	{
		$response = false;
		log_message('debug', "Reading cURL data: {$url}");

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		if ( ! $ch_data = curl_exec($ch) ) {
			return false;
		}
		if (
			curl_getinfo($ch, CURLINFO_HTTP_CODE) == "200" ||
			curl_getinfo($ch, CURLINFO_HTTP_CODE) == "302"
		) {
			$response = $ch_data;
			$this->_createCacheFile($ch_data, md5($url));
		}
		curl_close($ch);
		return $response;
	}
	
	/**
	 * Creates a cache file populated with data based on a URL
	 *
	 * @version		1.0.0
	 * @since		Version 1.0.0
	 * @access		private
	 * @param		$data string The data we need to cache
	 * @param		$url string A URL used as a unique identifier
	 * @return		void
	 **/
	private function _createCacheFile($data, $key)
	{
		$cache_path = APPPATH.'cache/' . NSM_DEVOT_EE_STATS_ADDON_ID;
		$filepath = $cache_path ."/". $key;
	
		if (! is_dir($cache_path)) {
			mkdir($cache_path . "", 0777, TRUE);
		}
		if (! is_really_writable($cache_path)) {
			return;
		}
		if ( ! $fp = fopen($filepath, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
			log_message('error', "Unable to write cache file: ".$filepath);
			return;
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);
		chmod($filepath, DIR_WRITE_MODE);

		log_message('debug', "Cache file written: " . $filepath);
	}

	/**
	 * Modify the download URL
	 *
	 * @version		1.0.0
	 * @since		Version 1.0.0
	 * @access		private
	 * @param		$versions array 
	 * @return		array Modified versions URL
	 **/
	private function _readCache($key)
	{
		$cache = FALSE;
		$cache_path = APPPATH.'cache/' . NSM_DEVOT_EE_STATS_ADDON_ID;
		$filepath = $cache_path ."/". $key;

		if ( ! file_exists($filepath)) {
			return FALSE;
		}
		if ( ! $fp = fopen($filepath, FOPEN_READ)) {
			@unlink($filepath);
			log_message('debug', "Error reading cache file. File deleted");
			return FALSE;
		}
		if ( ! filesize($filepath)) {
			@unlink($filepath);
			log_message('debug', "Error getting cache file size. File deleted");
			return FALSE;
		}
		
		// randomise cache timeout by 0-10mins to stagger cache regen
		$cache_timeout = $this->cache_lifetime + (rand(0,10) * 3600);
		
		if ( (filemtime($filepath) + $cache_timeout) < time() ) {
			@unlink($filepath);
			log_message('debug', "Cache file has expired. File deleted");
			return FALSE;
		}

		flock($fp, LOCK_SH);
		$cache = fread($fp, filesize($filepath));
		flock($fp, LOCK_UN);
		fclose($fp);

		return $cache;
	}


}