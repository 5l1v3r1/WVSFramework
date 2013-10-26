<?php

class WVSHTTP{

	private $user_agent_list = array(
			"Mozilla/5.0 (Windows NT 6.2; WOW64; rv:16.0.1) Gecko/20121011 Firefox/16.0.1",
            "Mozilla/5.0 (Windows NT 6.2; Win64; x64; rv:16.0.1) Gecko/20121011 Firefox/16.0.1",
            "Mozilla/5.0 (Windows NT 6.1; rv:15.0) Gecko/20120716 Firefox/15.0a2",
            "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.16) Gecko/20120427 Firefox/15.0a1",
            "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 Firefox/15.0a1",
			 "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.17 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36",
            "Mozilla/5.0 (X11; CrOS i686 4319.74.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.2 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1467.0 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1464.0 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36",
			 "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10",
            "Mozilla/5.0 (iPad; CPU OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko ) Version/5.1 Mobile/9B176 Safari/7534.48.3",
            "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; de-at) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1",
            "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1",
            "Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
            "Mozilla/5.0 (Windows; U; Windows NT 6.1; ko-KR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
            "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr-FR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
            "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
            "Mozilla/5.0 (Windows; U; Windows NT 6.1; cs-CZ) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
            "Mozilla/5.0 (Windows; U; Windows NT 6.0; ja-JP) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
            "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27",
			   "Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
            "Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14",
            "Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02",
            "Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00",
            "Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00",
            "Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00",
            "Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00",
            "Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0",
            "Opera/9.80 (Windows NT 6.1; WOW64; U; pt) Presto/2.10.229 Version/11.62",
            "Opera/9.80 (Windows NT 6.0; U; pl) Presto/2.10.229 Version/11.62",
	);
	private $useragent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36";
	private $random_useragent = false;
	private $url;
	private $method = 'get';
	private $postfield = array();
	private $followlocation = false;
	private $returnresult = true;
	public $content;
	public $header;
	public $rawheader;
	public $requestheader;
	public $httpstatus = false;
	public $httpcode;
	private $cookie = false;
	private $storecookie = false;
	private $temporary_dir;
	private $setheader = false;
	private $httpauth = false;
	private $httpauthstring = false;
	private $sethttpversion = false;
	private $setreferer = false;
	
	
	
	public function __construct(){
		$this->temporary_dir = sys_get_temp_dir();
	}
	
	public function setMethod($method){
		$this->method = $method;
		return $this;
	}
	
	public function PostField($fields){
		if(is_array($fields)) {
			$this->postfield = http_build_query($fields);
		} else {
			$this->postfield = $fields;
		}
		return $this;
	}
	
	public function execute(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);
		
		switch(strtolower($this->method)) {
			case 'post':
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postfield);
			break;
		}
		
		if($this->followlocation) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		}
		
		if($this->cookie) {
			curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
		}
		
		if($this->returnresult) {
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		}
		
		if($this->httpauth) {
			curl_setopt($ch, CURLOPT_HTTPAUTH, $this->httpauth ) ; 
			curl_setopt($ch, CURLOPT_USERPWD, $this->httpauthstring); 
		}
		
		if($this->sethttpversion) {
			switch($this->sethttpversion) {
				case '1.0':
					curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
				break;
				case '1.1':
					curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
				break;
			}
		}
		
		if($this->setreferer) {
			curl_setopt($ch, CURLOPT_REFERER, $this->setreferer);
		}
		
		if($this->storecookie) {
			if($this->temporary_dir) {
				$parse_url = @parse_url($this->url);
				if(isset($parse_url['host'])){
					curl_setopt($ch, CURLOPT_COOKIEFILE, $this->temporary_dir.'/'.$parse_url['host'].'.txt');
					curl_setopt($ch, CURLOPT_COOKIEJAR, $this->temporary_dir.'/'.$parse_url['host'].'.txt');
				}
			}
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		
		if($this->setheader) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->setheader);
		}
		
		
		$this->content = curl_exec($ch);
		if(!curl_errno($ch) && $this->content) {
			$this->header =  (object) curl_getinfo($ch);
			$this->httpstatus = $this->header->http_code;
			$this->httpcode = $this->header->http_code;
			list($this->rawheader, $this->content) = explode("\r\n\r\n", $this->content, 2);
			$this->requestheader = curl_getinfo($ch, CURLINFO_HEADER_OUT);
		} else {
			$this->httpstatus = false;
		}
		curl_close($ch);
		return $this;
	}
	
	
	public function success(){
		if($this->httpstatus) {
			return true;
		}
		return false;
	}
	
	public function setHTTPVersion($version){
		$this->sethttpversion = $version;
		return $this;
	}
	
	public function setHTTPAuth($type = 'CURLAUTH_BASIC', $authstring){
		$this->httpauth = $type;
		$this->httpauthstring = $authstring;
		return $this;
	}
	
	public function setCookie($cookies){
		if(is_array($cookies)) {
			$this->cookie = http_build_query($cookies);
		} else {
			$this->cookie = $cookies;
		}
		return $this;
	}
	
	public function setReferer($referer){
		$this->setreferer = $referer;
		return $this;
	}
	
	public function setHeader($headers = array()){
		if(is_array($headers)) {
			$this->setheader = $headers;
		}
		return $this;
	}
	
	public function storeCookie(){
		$this->storecookie = true;
		return $this;
	}
	
	public function setRandomUserAgent(){
		$rand_key = array_rand($this->user_agent_list, 1);
		$this->setUserAgent($this->user_agent_list[$rand_key]);
		return $this;
	}
	
	public function followLocation(){
		$this->followlocation = true;
		return $this;
	}
	
	public function unsetreturnResult(){
		$this->returnresult = false;
		return $this;
	}
	
	public function setURL($url) {
		$this->url = $url;
		return $this;
	}
	
	public function setUserAgent($useragent) {
		$this->useragent = $useragent;
		return $this;
	}
}

?>