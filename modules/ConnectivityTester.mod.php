<?php
	class ConnectivityTester {
		private $endpoint; // IP Address, hostname etc.
		private $timeout = 30;
		private $port = 80;
		private $type; //can be WEB or IPPRT
		
		function __construct($endpoint, $port, $type, $timeout)
		{
			$this->endpoint = $endpoint;
			$this->port = $port;
			$this->timeout = $timeout;
			$this->type = $type;
		}
		
		private function startsWith ($string, $startString) 
		{ 
			$len = strlen($startString); 
			return (substr($string, 0, $len) === $startString); 
		} 
		
		function Test()
		{
			$endpoint = $this->endpoint;
			
			if ( $endpoint == null )
				throw new Exception("No endpoint set");
			
			if ( $this->type == "WEB" )
			{
				if( $this->startsWith ( $endpoint, "https://" ) )
					$this->port = 443;

				if (preg_match("/^(([^:\/?#]+):)?(\/\/([^\/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?/", $endpoint, $matches)) {
					$endpoint = $matches[4];
				} else {
					return false;
				}
			}
			
			$fp = fsockopen($endpoint, $this->port, $errno, $errstr, $this->timeout);
			if (!$fp)
				return false;
			
			return true;
		}
	}
?>