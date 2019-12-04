<?php
	//error_reporting(E_ERROR | E_PARSE);
	require_once("inc/config.inc.php");
	
	$allSystemsOperational = true;
	foreach ( $serviceHandler->services as $service )
		if ( $service->status == 0 )
			$allSystemsOperational = false;
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PlayPlex.Media Status</title>
	
    <!-- Mobile viewport optimization h5bp.com/ad -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
    <meta http-equiv="cleartype" content="on">

    <!-- Le fonts -->
	<style>
	  @font-face {
		font-family: 'proxima-nova';
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-f0b2f7c12b6b87c65c02d3c1738047ea67a7607fd767056d8a2964cc6a2393f7.eot?host=discord.statuspage.io');
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-f0b2f7c12b6b87c65c02d3c1738047ea67a7607fd767056d8a2964cc6a2393f7.eot?host=discord.statuspage.io#iefix') format('embedded-opentype'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-e642ffe82005c6208632538a557e7f5dccb835c0303b06f17f55ccf567907241.woff?host=discord.statuspage.io') format('woff'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-0f094da9b301d03292f97db5544142a16f9f2ddf50af91d44753d9310c194c5f.ttf?host=discord.statuspage.io') format('truetype');
		font-weight:300;
		font-style:normal;
	  }
	   
	  @font-face {
		font-family: 'proxima-nova';
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-366d17769d864aa72f27defaddf591e460a1de4984bb24dacea57a9fc1d14878.eot?host=discord.statuspage.io');
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-366d17769d864aa72f27defaddf591e460a1de4984bb24dacea57a9fc1d14878.eot?host=discord.statuspage.io#iefix') format('embedded-opentype'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-2ee4c449a9ed716f1d88207bd1094e21b69e2818b5cd36b28ad809dc1924ec54.woff?host=discord.statuspage.io') format('woff'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-a40a469edbd27b65b845b8000d47445a17def8ba677f4eb836ad1808f7495173.ttf?host=discord.statuspage.io') format('truetype');
		font-weight:400;
		font-style:normal;
	  }
	   
	  @font-face {
		font-family: 'proxima-nova';
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-0bf83a850b45e4ccda15bd04691e3c47ae84fec3588363b53618bd275a98cbb7.eot?host=discord.statuspage.io');
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-0bf83a850b45e4ccda15bd04691e3c47ae84fec3588363b53618bd275a98cbb7.eot?host=discord.statuspage.io#iefix') format('embedded-opentype'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-0c394ec7a111aa7928ea470ec0a67c44ebdaa0f93d1c3341abb69656cc26cbdd.woff?host=discord.statuspage.io') format('woff'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-9e43859f8015a4d47d9eaf7bafe8d1e26e3298795ce1f4cdb0be0479b8a4605e.ttf?host=discord.statuspage.io') format('truetype');
		font-weight:400;
		font-style:italic;
	  }
	   
	  @font-face {
		font-family: 'proxima-nova';
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-09566917307251d22021a3f91fc646f3e45f8d095209bcd2cded8a1979f06e54.eot?host=discord.statuspage.io');
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-09566917307251d22021a3f91fc646f3e45f8d095209bcd2cded8a1979f06e54.eot?host=discord.statuspage.io#iefix') format('embedded-opentype'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-86724fb2152613d735ba47c3f47a9ad2424b898bea4bece213dacee40344f966.woff?host=discord.statuspage.io') format('woff'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-cf3e4eb7fbdf6fb83e526cc2a0141e55b01097e6e1abfd4cbdc3eda75d183f74.ttf?host=discord.statuspage.io') format('truetype');
		font-weight:500;
		font-style:normal;
	  }
	   
	  @font-face {
		font-family: 'proxima-nova';
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-622ea489d20e12e691663f83217105e957e2d3d09703707d40155a29c06cc9d9.eot?host=discord.statuspage.io');
		src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-622ea489d20e12e691663f83217105e957e2d3d09703707d40155a29c06cc9d9.eot?host=discord.statuspage.io#iefix') format('embedded-opentype'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-c8dc577ff7f76d2fc199843e38c04bb2e9fd15889421358d966a9f846c2ed1cd.woff?host=discord.statuspage.io') format('woff'),
			 url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-27177fe9242acbe089276ee587feef781446667ffe9b6fdc5b7fe21ad73e12f3.ttf?host=discord.statuspage.io') format('truetype');
		font-weight:700;
		font-style:normal;
	  }
	</style>

    <!-- Le styles -->
    <link rel="stylesheet" media="screen" href="./le/0.8291d7e38e66f269f252.css">
    <link rel="stylesheet" media="all" href="./le/status_manifest-243362a7df251188e1f8d87dbe67be112fc79c73d76c929231342a86f99a2f9c.css">

    <style>
  /* BODY BACKGROUND */ /* BODY BACKGROUND */ /* BODY BACKGROUND */ /* BODY BACKGROUND */ /* BODY BACKGROUND */
  body,
  .layout-content.status.status-api .section .example-container .example-opener .color-secondary,
  .grouped-items-selector,
  .layout-content.status.status-full-history .history-nav a.current,
  #uptime-tooltip .tooltip-box {
    background-color:#ffffff;
  }

  #uptime-tooltip .pointer-container .pointer-smaller {
    border-bottom-color:#ffffff;
  }




  /* PRIMARY FONT COLOR */ /* PRIMARY FONT COLOR */ /* PRIMARY FONT COLOR */ /* PRIMARY FONT COLOR */
  body.status,
  .color-primary,
  .color-primary:hover,
  .layout-content.status-index .status-day .update-title.impact-none a,
  .layout-content.status-index .status-day .update-title.impact-none a:hover,
  .layout-content.status-index .timeframes-container .timeframe.active,
  .layout-content.status-full-history .month .incident-container .impact-none,
  .layout-content.status.status-index .incidents-list .incident-title.impact-none a,
  .incident-history .impact-none,
  .layout-content.status .grouped-items-selector.inline .grouped-item.active,
  .layout-content.status.status-full-history .history-nav a.current,
  .layout-content.status.status-full-history .history-nav a:not(.current):hover,
  #uptime-tooltip .tooltip-box .tooltip-content .related-events .related-event a.related-event-link {
    color:#737F8D;
  }

  .layout-content.status.status-index .components-statuses .component-container .name {
    color:#737F8D;
    color:rgba(115,127,141,.8);
  }




  /* SECONDARY FONT COLOR */ /* SECONDARY FONT COLOR */ /* SECONDARY FONT COLOR */ /* SECONDARY FONT COLOR */
  small,
  .layout-content.status .table-row .date,
  .color-secondary,
  .layout-content.status .grouped-items-selector.inline .grouped-item,
  .layout-content.status.status-full-history .history-footer .pagination a.disabled,
  .layout-content.status.status-full-history .history-nav a,
  #uptime-tooltip .tooltip-box .tooltip-content .related-events #related-event-header {
    color:#99aab5;
  }




  /* BORDER COLOR */  /* BORDER COLOR */  /* BORDER COLOR */  /* BORDER COLOR */  /* BORDER COLOR */  /* BORDER COLOR */
  body.status .layout-content.status .border-color,
  hr,
  .tooltip-base,
  .markdown-display table,
  #uptime-tooltip .tooltip-box {
    border-color:#E0E0E0;
  }

  .markdown-display table td {
    border-top-color:#E0E0E0;
  }

  .markdown-display table td + td, .markdown-display table th + th {
    border-left-color:#E0E0E0;
  }

  #uptime-tooltip .pointer-container .pointer-larger {
    border-bottom-color:#E0E0E0;
  }

  #uptime-tooltip .tooltip-box .outage-field {
    /*
      Generate the background-color for the outage-field from the css_body_background_color and css_border_color.

      For the default background (#ffffff) and default css_border_color (#e0e0e0), use the luminosity of the default background with a magic number to arrive at
      the original outage-field background color (#f4f5f7). I used the formula Target Color = Color * alpha + Background * (1 - alpha) to find the magic number of ~0.08.

      For darker css_body_background_color, luminosity values are lower so alpha trends toward becoming transparent (thus outage-field background becomes same as css_body_background_color).
    */
    background-color: rgba(224,224,224,0.31);

    /*
      outage-field border-color alpha is inverse to the luminosity of css_body_background_color.
      That is to say, with a default white background this border is transparent, but on a black background, it's opaque css_border_color.
    */
    border-color: rgba(224,224,224,0.0);
  }




  /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */
  .layout-content.status.status-index .status-day .update-title.impact-critical a,
  .layout-content.status.status-index .status-day .update-title.impact-critical a:hover,
  .layout-content.status.status-index .page-status.status-critical,
  .layout-content.status.status-index .unresolved-incident.impact-critical .incident-title,
  .flat-button.background-red {
    background-color:#f04747;
  }

  .layout-content.status-index .components-statuses .component-container.status-red:after,
  .layout-content.status-full-history .month .incident-container .impact-critical,
  .layout-content.status-incident .incident-name.impact-critical,
  .layout-content.status.status-index .incidents-list .incident-title.impact-critical a,
  .status-red .icon-indicator,
  .incident-history .impact-critical,
  .components-container .component-inner-container.status-red .component-status,
  .components-container .component-inner-container.status-red .icon-indicator {
    color:#f04747;
  }

  .layout-content.status.status-index .unresolved-incident.impact-critical .updates {
    border-color:#f04747;
  }




  /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */
  .layout-content.status.status-index .status-day .update-title.impact-major a,
  .layout-content.status.status-index .status-day .update-title.impact-major a:hover,
  .layout-content.status.status-index .page-status.status-major,
  .layout-content.status.status-index .unresolved-incident.impact-major .incident-title {
    background-color:#f26522;
  }

  .layout-content.status-index .components-statuses .component-container.status-orange:after,
  .layout-content.status-full-history .month .incident-container .impact-major,
  .layout-content.status-incident .incident-name.impact-major,
  .layout-content.status.status-index .incidents-list .incident-title.impact-major a,
  .status-orange .icon-indicator,
  .incident-history .impact-major,
  .components-container .component-inner-container.status-orange .component-status,
  .components-container .component-inner-container.status-orange .icon-indicator {
    color:#f26522;
  }

  .layout-content.status.status-index .unresolved-incident.impact-major .updates {
    border-color:#f26522;
  }




  /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */
  .layout-content.status.status-index .status-day .update-title.impact-minor a,
  .layout-content.status.status-index .status-day .update-title.impact-minor a:hover,
  .layout-content.status.status-index .page-status.status-minor,
  .layout-content.status.status-index .unresolved-incident.impact-minor .incident-title,
  .layout-content.status.status-index .scheduled-incidents-container .tab {
    background-color:#faa61a;
  }

  .layout-content.status-index .components-statuses .component-container.status-yellow:after,
  .layout-content.status-full-history .month .incident-container .impact-minor,
  .layout-content.status-incident .incident-name.impact-minor,
  .layout-content.status.status-index .incidents-list .incident-title.impact-minor a,
  .status-yellow .icon-indicator,
  .incident-history .impact-minor,
  .components-container .component-inner-container.status-yellow .component-status,
  .components-container .component-inner-container.status-yellow .icon-indicator,
  .layout-content.status.manage-subscriptions .confirmation-infobox .fa {
    color:#faa61a;
  }

  .layout-content.status.status-index .unresolved-incident.impact-minor .updates,
  .layout-content.status.status-index .scheduled-incidents-container {
    border-color:#faa61a;
  }




  /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */
  .layout-content.status.status-index .status-day .update-title.impact-maintenance a,
  .layout-content.status.status-index .status-day .update-title.impact-maintenance a:hover,
  .layout-content.status.status-index .page-status.status-maintenance,
  .layout-content.status.status-index .unresolved-incident.impact-maintenance .incident-title,
  .layout-content.status.status-index .scheduled-incidents-container .tab {
    background-color:#3498DB;
  }

  .layout-content.status-index .components-statuses .component-container.status-blue:after,
  .layout-content.status-full-history .month .incident-container .impact-maintenance,
  .layout-content.status-incident .incident-name.impact-maintenance,
  .layout-content.status.status-index .incidents-list .incident-title.impact-maintenance a,
  .status-blue .icon-indicator,
  .incident-history .impact-maintenance,
  .components-container .component-inner-container.status-blue .component-status,
  .components-container .component-inner-container.status-blue .icon-indicator {
    color:#3498DB;
  }

  .layout-content.status.status-index .unresolved-incident.impact-maintenance .updates,
  .layout-content.status.status-index .scheduled-incidents-container {
    border-color:#3498DB;
  }




  /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */
  .layout-content.status.status-index .page-status.status-none {
    background-color:#43b581;
  }
  .layout-content.status-index .components-statuses .component-container.status-green:after,
  .status-green .icon-indicator,
  .components-container .component-inner-container.status-green .component-status,
  .components-container .component-inner-container.status-green .icon-indicator {
    color:#43b581;
  }




  /* CSS LINK COLOR */  /* CSS LINK COLOR */  /* CSS LINK COLOR */  /* CSS LINK COLOR */  /* CSS LINK COLOR */  /* CSS LINK COLOR */
  a,
  a:hover,
  .layout-content.status-index .page-footer span a:hover,
  .layout-content.status-index .timeframes-container .timeframe:not(.active):hover,
  .layout-content.status-incident .subheader a:hover {
    color:#738bd7;
  }

  .flat-button,
  .masthead .updates-dropdown-container .show-updates-dropdown,
  .layout-content.status-full-history .show-filter.open  {
    background-color:#738bd7;
  }




  /* CUSTOM COLOR OVERRIDES FOR UPTIME SHOWCASE */
  .components-section .components-uptime-link {
    color: #99aab5;
  }

  .layout-content.status .shared-partial.uptime-90-days-wrapper .legend .legend-item {
    color: #99aab5;
    opacity: 0.8;
  }
  .layout-content.status .shared-partial.uptime-90-days-wrapper .legend .legend-item.light {
    color: #99aab5;
    opacity: 0.5;
  }
  .layout-content.status .shared-partial.uptime-90-days-wrapper .legend .spacer {
    background: #99aab5;
    opacity: 0.3;
  }
</style>

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="./img/styles.css">

    <!-- Le HTML5 shim -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>


  <body class="status index status-none" data-breakpoint-reached="false">


  <div class="layout-content status status-index starter">
    <div class="masthead-container basic">

    <div class="masthead has-logo">
        <div class="logo-container">
          <a href="http://www.agngaming.com/"><img style="" src="./img/agnlogo_long.png"></a>
        </div>
      <div class="clearfix"></div>
    </div>

	</div>
    <div class="container">
        <div class="page-status status-<?=$allSystemsOperational ? "none" : "critical"?>">
          <span class="status font-large">
		    <?=$allSystemsOperational ? "All Systems Operational" : "Problems Detected!"?>
          </span>
        </div>

        <div class="components-section font-regular">
			<hr>
			
			<?php
				foreach ( $serviceHandler->services as $service )
				{
					echo ( '
						<div class="components-container one-column">
							<!-- SERVICE CONTAINER START -->
							<div class="component-container border-color">
								<div class="component-inner-container status-' . ($service->status ? "green" : "red") . ' showcased">

								   <span class="name">
									  ' . $service->name . '
								   </span>

								  <span class="component-status" title="">
									' . ($service->status ? "Online" : "Offline") . '
								  </span>
								  
								  <div class="shared-partial uptime-90-days-wrapper">
									  <svg class="availability-time-line-graphic" id="uptime-component-rhznvxg4v7yh" preserveAspectRatio="none" height="34" viewBox="0 0 448 34">');
									  
					$blipNumber = 0;
					$xOffset = 0;
					$color = "#0000FF"; //Set to blue by default, just to see errors
					foreach ( $service->metrics as $metric )
					{
						switch ( $metric->status )
						{
							case -1: $color = "#AAAAAA"; break;
							case 0: $color = "#ff0000"; break;
							case 1: $color = "#43b581"; break;
						}
						echo ( '<rect height="34" width="3" x="' . $xOffset . '" y="0" fill="' . $color . '" class="uptime-day day-' . $blipNumber . '" data-html="true"></rect>' );

						$xOffset = $xOffset + 5;
						$blipNumber++;
					}
										
					$timeAgo = new DateTime($service->metrics[sizeof($service->metrics)-1]->date);
					$timeNow = new DateTime();
					$timeDiff = $timeNow->diff($timeAgo);
					echo ('				</svg>
									  <div class="legend ">
									  
									  <div class="legend-item light legend-item-date-range"><span class="availability-time-line-legend-day-count">' . (($CONFIG->timespan * 5) / 60) . ' </span> hours ago</div>
									  <div class="spacer"></div>
									  <div class="legend-item legend-item-uptime-value legend-item-9lgt8qqpcqck"><span id="uptime-percent-9lgt8qqpcqck">' . $service->description . '</span></div>
									  
									  <div class="spacer"></div>
									  <div class="legend-item light legend-item-date-range">' . ($timeDiff->format("%i") == "0" ? $timeDiff->format("%ss second(s)") : $timeDiff->format("%i minute(s)")) . ' ago</div>
									</div>

									</div>
								  

								</div>
							</div>
							<!-- SERVICE CONTAINER END -->
						</div>
						<hr>');
				}
				
				/*
				<?php
								  
								  if ( !$plexCTTest ) {
									echo  "<br /> <div align=\"center\">PLEX is currently offline for maintenance.</div>";
								  }
								  ?>
				*/
			?>
			
			
			<div align="center">
				I created this website to attempt to stop people from pestering me whenever my services are offline for maintenance.<br />By using PlayPlex.Media you can clearly see for yourself at any time the current live status of my services.
				<br /><br />
				Created by AlienX
			</div>
		</div>
    </div>
  </div>
</body></html>