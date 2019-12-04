<?php
	error_reporting(E_ERROR | E_PARSE);
	require_once("inc/config.inc.php");
	
	$dbCon = $CONFIG->GetDatabaseConfig()->databaseConnection;
	$currentTimeStamp = date('Y-m-d H:i:s');;
	
	function ConsoleEcho($m, $fc=null, $bc=null)
	{
		$colors = new Colors();
		echo $colors->getColoredString($m, $fc, $bc);
		echo "\r\n";
	}
	
	class Colors {
		private $foreground_colors = array();
		private $background_colors = array();

		public function __construct() {
			// Set up shell colors
			$this->foreground_colors['black'] = '0;30';
			$this->foreground_colors['dark_gray'] = '1;30';
			$this->foreground_colors['blue'] = '0;34';
			$this->foreground_colors['light_blue'] = '1;34';
			$this->foreground_colors['green'] = '0;32';
			$this->foreground_colors['light_green'] = '1;32';
			$this->foreground_colors['cyan'] = '0;36';
			$this->foreground_colors['light_cyan'] = '1;36';
			$this->foreground_colors['red'] = '0;31';
			$this->foreground_colors['light_red'] = '1;31';
			$this->foreground_colors['purple'] = '0;35';
			$this->foreground_colors['light_purple'] = '1;35';
			$this->foreground_colors['brown'] = '0;33';
			$this->foreground_colors['yellow'] = '1;33';
			$this->foreground_colors['light_gray'] = '0;37';
			$this->foreground_colors['white'] = '1;37';

			$this->background_colors['black'] = '40';
			$this->background_colors['red'] = '41';
			$this->background_colors['green'] = '42';
			$this->background_colors['yellow'] = '43';
			$this->background_colors['blue'] = '44';
			$this->background_colors['magenta'] = '45';
			$this->background_colors['cyan'] = '46';
			$this->background_colors['light_gray'] = '47';
		}

		// Returns colored string
		public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";

			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}

			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";

			return $colored_string;
		}

		// Returns all foreground color names
		public function getForegroundColors() {
			return array_keys($this->foreground_colors);
		}

		// Returns all background color names
		public function getBackgroundColors() {
			return array_keys($this->background_colors);
		}
	}
	
	ConsoleEcho ("Starting php doCron Task for PlayPlexMedia Status", "green");
	ConsoleEcho("");

	foreach ( $serviceHandler->services as $service )
	{
		$result = false;
		ConsoleEcho ("Scanning service " . $service->name, "yellow");
		ConsoleEcho (" > Type is " . $service->pathType, "light_blue");
		if (preg_match('/^(\d[\d.]+):(\d+)\b/', $service->path, $matches)) {
			$ip = $matches[1];
			$port = $matches[2];
			ConsoleEcho (" > IP: " . $ip . " | Port: " . $port, "light_blue");
		} else {
			$ip = $service->path;
			$port = null;
		}

		$conTester = new ConnectivityTester($ip, $port, $service->pathType, 5);
		$conTesterTest = $conTester->Test();
		if ( $conTesterTest ) {
			ConsoleEcho ( " > SUCCESS: Successfully connected to endpoint", "white", "green" );
			$result = true;
		} else {
			ConsoleEcho ( " > ERROR: Unable to connect to endpoint", "white", "red" );
		}
		
		ConsoleEcho ( " > Updating database with result", "light_blue");
		$sqlData = array (
			"id" => null,
			"sid" => $service->id,
			"created" => $currentTimeStamp,
			"metric" => $result ? "1" : "0"
		);		
		$id = $dbCon->insert('status', $sqlData);
		if ( $id ) {
			ConsoleEcho ( " > DB insert successful (" . $id . ")", "light_blue" );
		} else {
			ConsoleEcho ( $dbCon->getLastError(), "white", "red" );
		}
		
		ConsoleEcho("");
	}

	$dbCon->disconnect();

?>
