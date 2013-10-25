<?php
require 'configuration.php';
require 'functions.php';
require 'wvscore.php';
require 'interface_plugin.php';
class WVSFramework{

	private $plugins = array();
	public $default_config = 'wvsconfig.ini';
	private $ignore_plugin = array();
	private $use_plugin = array();
	private $scan_url;
	
	public function __construct(){
		
	}
	
	public function loadPlugins(){
		$classes = glob(PLUGIN_PATH.'/*.php');
		if($classes && sizeof($classes) > 0) {
			foreach($classes as $class_file) {
				$class_name = explode(".", $class_file);
				$class_name = basename($class_name[0]);
				if(!class_exists($class_name)) {
				 require_once($class_file);
				 $this->plugins[$class_name] = new $class_name;
				}
			}
		}
	}
	
	public function initPlugin(){
		if(sizeof($this->plugins) > 0) {
			foreach($this->plugins as $plugin) {
				if(sizeof($this->use_plugin) > 0) {
					if(in_array(strtolower(get_class($plugin)), $this->use_plugin)) {
						$plugin->OnStart();
					}
				} else {
						if(sizeof($this->ignore_plugin) > 0) {
							if(!in_array(strtolower(get_class($plugin)), $this->ignore_plugin)) {
								$plugin->OnStart();
							}
						} else {
							$plugin->OnStart($this->scan_url);
						}
				}
			}
		}
	}
	
	
	private function isphpVersionCompatible(){
		if(version_compare(phpversion(), MINIMUM_PHP_VERSION, '<')) {
			return false;
		}
		return true;
	}
	
	private function isphpCurlExists(){
		if(function_exists('curl_exec') && function_exists('curl_init')) {
			return true;
		}
		return false;
	}
	
	private function isCLIMode() {
		if(php_sapi_name() == "cli") {
			return true;
		}
		return false;
	}
	
	private function checkSystemRequirement() {
	
		if(!$this->isphpVersionCompatible()) {
			MessageAndExit("Error: Minimum require php version to running this framework is ".MINIMUM_PHP_VERSION."\r\n");
		}
		
		if(!$this->isCLIMode()) {
			MessageAndExit("Error: Please running this script on console/cli mode\r\n");
		}
		
		if(!$this->isphpCurlExists()) {
			MessageAndExit("Error: This framework require php curl enabled\r\n");
		}
		
	}
	
	private function DisplayHeader(){
		$header = "";
		$header.= "
+-++-++-++-++-++-++-++-++-++-++-++-+
|W||V||S||F||r||a||m||e||w||o||r||k|
+-++-++-++-++-++-++-++-++-++-++-++-+
		\r\n";
		$header .="\r\n";
		$header .= "[-] Web vulnerability scanner framework\r\n";
		$header .= "[-] Version: ".FRAMEWORK_VERSION."\r\n";
		echo $header;
	}
	
	function TotalPluginLoaded(){
		return sizeof($this->plugins);
	}
	
	function DisplayPluginTotalHeader(){
		echo "[-] Total plugin loaded: ".$this->TotalPluginLoaded()."\r\n";
	}
	
	public function run(){
		$this->DisplayHeader();
		$this->checkSystemRequirement();
		$this->loadPlugins();
		$this->DisplayPluginTotalHeader();
		echo "\r\n";
		
		$options = getopt('f:', array('required:'));
		
		if(is_array($options) && sizeof($options) > 0) {
			//next time
		} else {
			if(!@file_exists(SYSTEM_PATH.'/'.$this->default_config)) {
				MessageAndExit("Error: No default config file ".$this->default_config." found at the current directory\r\n");
			} else {
			
				$parse_config = @parse_ini_file(SYSTEM_PATH.'/'.$this->default_config, true);
				if(is_array($parse_config) && sizeof($parse_config) > 0) {
				
						if(!isset($parse_config['config']['scan_url'])) {
							MessageAndExit("Error: Parsing configuration file failed (No scan_url option defined)\r\n");
						}
						
						$this->scan_url = $parse_config['config']['scan_url'];
						
						if(isset($parse_config['config']['use_plugin']) && sizeof(isset($parse_config['config']['use_plugin'])) > 0) {
							$this->use_plugin = $parse_config['config']['use_plugin'];
						}
						
						if(isset($parse_config['config']['ignore_plugin']) && sizeof(isset($parse_config['config']['ignore_plugin'])) > 0) {
							$this->ignore_plugin = $parse_config['config']['ignore_plugin'];
						}
				}
				
			}
		}
		
		$this->initPlugin();
	}
}

?>