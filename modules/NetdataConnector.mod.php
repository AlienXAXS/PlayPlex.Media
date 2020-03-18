<?php
	class NetdataConnector
	{
		private $server;
		private $port;
		
		function __construct($server, $port)
		{
			$this->server = $server;
			$this->port = $port;
		}
	}
?>