<? include_once($_SERVER['DOCUMENT_ROOT'] . '/202-config/connect.php'); 

AUTH::require_user();

//check if its the latest verison
$_SESSION['update_needed'] = update_needed();

		$to = 'xxxxxxx@txt.att.net';
		$subject = 'Alert202';
		$message = 'something is down!';
		$from = "propser202@".$_SERVER['SERVER_NAME'];
		
		$header = "From: Propser202<" . $from . "> \r\n";
	    	$header .= "Reply-To: ".$from." \r\n";
	    	$header .=  "To: " . $to . " \r\n";
	    	$header .= "Content-Type: text; charset=\"iso-8859-1\" \r\n";
	    	$header .= "Content-Transfer-Encoding: 8bit \r\n";
	    	$header .= "MIME-Version: 1.0 \r\n";
				
		//mail($to,$subject,$message,$header);


 
template_top();  ?>

<div class="slim">
		<div class="welcome">
			
		<? /*
			<table cellspacing="0" cellpadding="0" class="section">
				<tr>
					<td class="left" ><h2>Welcome</h2></td>
					<td><hr></td>
				</tr>
			</table>
			<p >Use these links to get started:</p>
			<ul>
				<li><a href="/tracking202">Track Your PPC Campaigns</a></li>
				<li><a href="/export202">Duplicate Your PPC Campaigns</a></li>
			</ul>
			Need help with Prosper202? Please visit the <a href="http://prosper202.com/forum">support forums</a>.<br/><br/>*/ ?>
			
			<table cellspacing="0" cellpadding="0" class="section">
				<tr>
					<td class="left" ><h2>Sponsor <a href="http://prosper202.com/advertise/" style="font-size: 10px;">(advertise)</span></h2></td>
					<td><hr></td>
				</tr> 
			</table>
			<p><iframe class="advertise" src="http://prosper202.com/ads/prosper202/" scrolling="no" frameborder="0"></iframe></p> 
			
			<table cellspacing="0" cellpadding="0" class="section">
				<tr>
					<td class="left" ><h2>Prosper202 Development Blog</h2></td>
					<td><hr></td>
				</tr>
			</table><?php
			 $rss = fetch_rss('http://prosper202.com/blog/rss/');
			 if ( isset($rss->items) && 0 != count($rss->items) ) {
			 	
			 	$rss->items = array_slice($rss->items, 0, 3);
			 	foreach ($rss->items as $item ) { 
			 		
			 		$item['description'] = html2txt($item['description']);
			 		
			 		if (strlen($item['description']) > 350) { 
			 			$item['description'] = substr($item['description'],0,350) . ' [...]';
			 		} ?>
			 		
				<h4><a href='<?php echo ($item['link']); ?>'><?php echo $item['title']; ?></a> - <?php printf(('%s ago'), human_time_diff(strtotime($item['pubdate'], time() ) )) ; ?></h4>
				<p><?php echo $item['description']; ?></p>
				<?php }
			} ?>

		</div>
		
		<div class="products">
			<table cellspacing="0" cellpadding="0" class="section">
				<tr>
					<td class="left"><h2>My Applications</h2></td>
					<td><hr></td>
				</tr>
			</table>
			<table cellspacing="0" cellpadding="0" class="apps">
				<? /*<tr>
					<td class="product-image"><img src="http://www.google.com/options/iconss/alerts.gif"/></td>
					<td><a href="#">Alerts</a><br/>Get SMS alerts if your landing page or host goes down.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="http://www.google.com/options/iconss/web.gif"/></td>
					<td><a href="#">Keywords</a><br/>The keyword generator tool.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="http://www.google.com/options/iconss/gmail.gif"/></td>
					<td><a href="#">Autoresponder</a><br/>Manager your own mailing list.</td>
				</tr>
				
				<tr>
					<td class="product-image"><img src="http://www.google.com/options/iconss/translate.gif"/></td>
					<td><a href="#">Campaign Builder</a><br/>Create large adgroups in seconds</td>
				</tr>
				<tr>
					<td class="product-image"><img src="/202-img/icons/tracking202.png"/></td>
					<td><a href="/tracking202api/">Tracking202 API</a><br/>Enjoy 99.99% accurate cost tracking.</td>
				</tr> */ ?>
				<tr>
					<td class="product-image"><img src="/202-img/icons/tracking202.png"/></td>
					<td><a href="/tracking202/">Tracking202</a><br/>PPC affiliate conversion tracking software.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="/202-img/icons/export202.png"/></td>
					<td><a href="/export202/">Export202</a><br/>Duplicate your PPC campaigns to other networks.</td>
				</tr>
				
			</table>
			<br/>
			<table cellspacing="0" cellpadding="0" class="section">
				<tr>
					<td class="left"><h2>Extra Resources</h2></td>
					<td><hr></td>
				</tr>
			</table>
		
			<table cellspacing="0" cellpadding="0" class="apps">
				<tr>
					<td class="product-image"><img src="/202-img/icons/blog.png"/></td>
					<td><a href="http://prosper202.com/blog">Blog</a> - <a href="http://twitter.com/wesmahler/">Twitter</a><br/>The official Prosper202 company blog and twitter.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="/202-img/icons/forum.png"/></td>
					<td><a href="http://prosper202.com/forum">Forum</a><br/>Talk with other users, and get help.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="/202-img/icons/newsletter.png"/></td>
					<td><a href="http://prosper202.com/newsletter">Newsletter</a><br/>Subscribe to the Prosper202 newsletter.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="/202-img/icons/meetup202.png"/></td>
					<td><a href="http://meetup202.com">Meetup202</a><br/>Affiliate Marketing Meetup Groups around the World.</td>
				</tr>
				<tr>
					<td class="product-image"><img src="/202-img/icons/worldproxy202.png"/></td>
					<td><a href="http://worldproxy202.com">WorldProxy202</a><br/>Proxies from around the world to view international offers.</td>
				</tr>
			</table>
		</div>
	</div>
<? template_bottom(); ?>