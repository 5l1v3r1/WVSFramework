<?php

class WVSPlugin {
	private static $instance;
	
	public function __construct(){
		$classes = glob(CORE_PATH.'/*.php');
		if($classes && sizeof($classes) > 0) {
			foreach($classes as $class_file) {
				$class_name = explode(".", $class_file);
				$class_name = basename($class_name[0]);
				 require_once($class_file);
				 $this->$class_name = new $class_name;
			}
		}	
	}
	
}
?>