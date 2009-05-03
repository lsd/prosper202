
<div style="padding: 10px 0px;"></div>

<div id="nav-primary">  
			<ul name="navbar">

						  <li <? if ($navigation[2] == 'setup') { echo ' class="on" '; } ?>><a href="/tracking202/setup" name="setup">Setup</a></li>
						  <li <? if (($navigation[1] == 'account' and !$navigation[2]) or ($navigation[2] == 'overview'))  { echo ' class="on" '; } ?>><a href="/tracking202" name="home">Overview</a></li>
						  <li <? if ($navigation[2] == 'analyze') { echo ' class="on" '; } ?>><a href="/tracking202/analyze" name="jobs">Analyze</a></li>
						  <li <? if ($navigation[2] == 'visitors') { echo ' class="on" '; } ?>><a href="/tracking202/visitors" name="visitors">Visitors</a></li>      
						  <li <? if ($navigation[2] == 'spy') { echo ' class="on" '; } ?>><a href="/tracking202/spy" name="spy">Spy</a></li>
						  <li <? if ($navigation[2] == 'update') { echo ' class="on" '; } ?>><a href="/tracking202/update" name="update">Update</a></li>
						 
	
			</ul>
		  </div>
		 
		  <div id="nav-secondary" <? if (($navigation[1] == 'forum') or ($navigation[1] == 'blog') or ($navigation[1] == 'misc') or ($navigation[1] == 'videos')) { echo ' class="core" '; } ?>>
		  
		  <div>

			<? if ($navigation[2] == 'setup') { $nav = true; ?>
				<ul>
					<li <? if ($navigation[3] == 'ppc_accounts.php' or !$navigation[3]) { echo ' class="on" '; } ?>><a href="/tracking202/setup/ppc_accounts.php">#1 PPC Accounts</a></li>
					<li <? if ($navigation[3] == 'aff_networks.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/aff_networks.php">#2 Aff Networks</a></li>
					<li <? if ($navigation[3] == 'aff_campaigns.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/aff_campaigns.php">#3 Aff Campaigns</a></li>
					<li <? if ($navigation[3] == 'landing_pages.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/landing_pages.php">#4 Landing Pages</a></li>
					<li <? if ($navigation[3] == 'text_ads.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/text_ads.php">#5 Text Ads</a></li>
					<li <? if ($navigation[3] == 'get_landing_code.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/get_landing_code.php">#6 Get LP Code</a></li> 
					<li <? if ($navigation[3] == 'get_trackers.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/get_trackers.php">#7 Get Links</a></li> 
					<li <? if ($navigation[3] == 'get_postback.php') { echo ' class="on" '; } ?>><a href="/tracking202/setup/get_postback.php">#8 Get Postback/Pixel</a></li> 
				</ul>
			<? } ?>
			
			<? if (($navigation[1] == 'account' and !$navigation[2]) or ($navigation[2] == 'overview')) { $nav = true; ?>
				<ul>
					<li <? if ($navigation[3] == 'campaign.php' or !$navigation[3]) { echo ' class="on" '; } ?>><a href="/tracking202/overview">Campaign Overview</a></li>
					<li <? if ($navigation[3] == 'daily.php') { echo ' class="on" '; } ?>><a href="/tracking202/overview/daily.php">Daily Overview</a></li>
					<li <? if ($navigation[3] == 'hourly.php') { echo ' class="on" '; } ?>><a href="/tracking202/overview/hourly.php">Hourly Overview</a></li>
				</ul>
			<? } ?>
			
			<? if ($navigation[2] == 'analyze') { $nav = true; ?>
				<ul>
					<li <? if ($navigation[3] == 'keywords.php' or !$navigation[3]) { echo ' class="on" '; } ?>><a href="/tracking202/analyze/keywords.php">Keywords</a></li>
					<li <? if ($navigation[3] == 'text_ads.php') { echo ' class="on" '; } ?>><a href="/tracking202/analyze/text_ads.php">Text Ads</a></li>
					<li <? if ($navigation[3] == 'referers.php') { echo ' class="on" '; } ?>><a href="/tracking202/analyze/referers.php">Referers</a></li>
					<li <? if ($navigation[3] == 'ips.php') { echo ' class="on" '; } ?>><a href="/tracking202/analyze/ips.php">IPs</a></li>
					<li <? if ($navigation[3] == 'landing_pages.php') { echo ' class="on" '; } ?>><a href="/tracking202/analyze/landing_pages.php">Landing Pages</a></li>
				</ul>
			<? } ?>
			
			
			<? if ($navigation[2] == 'update') {  $nav = true;?>
				<ul>
					<li <? if ($navigation[3] == 'subids.php' or !$navigation[3]) { echo ' class="on" '; } ?>><a href="/tracking202/update/subids.php">Update Subids</a></li>
					<li <? if ($navigation[3] == 'cpc.php') { echo ' class="on" '; } ?>><a href="/tracking202/update/cpc.php">Update CPC</a></li>
					<li <? if ($navigation[3] == 'clear-subids.php') { echo ' class="on" '; } ?>><a href="/tracking202/update/clear-subids.php">Reset Campaign Subids</a></li>
					<li <? if ($navigation[3] == 'delete-subids.php') { echo ' class="on" '; } ?>><a href="/tracking202/update/delete-subids.php">Delete Subids</a></li>
					<li <? if ($navigation[3] == 'upload.php') { echo ' class="on" '; } ?>><a href="/tracking202/update/upload.php">Upload Revenue Reports <span style="color: yellow"> - (new)*</span></a></li>
				</ul>
			<? } ?>
			
			<? if ($nav != true) { ?><ul><li></li></ul><? } ?>
</div>
</div>
