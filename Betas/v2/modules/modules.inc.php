<?php
	// Grab all of the files in the "modules" directory
	$files = array_diff(scandir("./modules"), array("..", "."));
	
	foreach ( $files as $file )
		if (strpos($file, '.mod.') !== false)
			require_once($file);
?>