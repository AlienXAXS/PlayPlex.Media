<?php

	$config = include("../../inc/config.netdata.inc.php");

	if ( !isset($_GET['rt']) ) die("nope");
	
	$requestType = $_GET['rt'];

	if ($requestType == "chart" || $requestType == "data")
	{	

		header("Content-Type: application/json; charset=utf-8");

		$url = $config['netdataRouterRemoteUrl'] . $requestType;
		$skip = true;
		$first = true;
		foreach ( $_GET as $get => $value )
		{
			if ( $skip ) {
				$skip = false;
				continue;
			}
			
			$url .= ($first ? "?" : "&") . $get . "=" . $value;			
			$first = false;
		}


		//die ($url);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($curl, CURLOPT_FAILONERROR, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
		$html = curl_exec($curl); 
		
		// Fix URLs in HTML
		$html = str_replace("/api/v1/data", "/netdataRouter.php?rt=data", $html);
		$html = str_replace("data?chart", "data&chart", $html);
		
		echo ($html);
		
		curl_close($curl);
		return;
	}

	echo "unsupported";
	
?>