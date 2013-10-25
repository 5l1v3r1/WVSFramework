<?php

class HTTPRequestDemo extends WVSPlugin implements Plugin{

	public function __construct(){
		parent::__construct();
	}
	
	public function OnStart($url){
		echo "Simple HTTPRequestDemo Plugin\r\n";
		var_dump($this->wvshttp->setURL($url)->execute()->header);
		var_dump($this->wvshttp->setURL($url)->execute()->result);
	}
	
}

?>