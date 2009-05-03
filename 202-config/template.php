<?  function template_top($title = 'Prosper202 Self Hosted Apps') { global $navigation; global $version;  ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>

<title><? echo $title; ?></title>
<meta name="description" content="description" />
<meta name="keywords" content="keywords"/>
<meta name="copyright" content="Prosper202, Inc" />
<meta name="author" content="Prosper202, Inc" />
<meta name="MSSmartTagsPreventParsing" content="TRUE"/>

<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="imagetoolbar" content="no"/>
  
<link rel="shortcut icon" href="/202-img/favicon.gif" type="image/ico"/> 
<link href="/202-css/account.css" rel="stylesheet" type="text/css"/>

<? if (($navigation[1] == 'tracking202') or ($navigation[1] =='tracking202api')) { ?>
<link href="/202-css/tracking202.css" rel="stylesheet" type="text/css"/>
<link href="/202-css/scal.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/tracking202/js/tracking202scripts.js"></script>  
<script type="text/javascript" src="/tracking202/js/call_prefs.js"></script>  
<script type="text/javascript" src="/tracking202/js/prototype.js"></script>   
<script type="text/javascript" src="/tracking202/js/scriptaculous/scriptaculous.js"></script>
<script type="text/javascript" src="/tracking202/js/scal.js"></script>  

<? } ?>

<body>


<div class="body">


	<div class="body-content">

	<div class="skyline">
		<a href="/202-account">Home</a>  
		&middot;
		<a href="/202-account/account.php">My Account</a>  
		&middot; 
		<a href="/202-account/administration.php">Administration</a>  
		&middot; 
		<a href="/202-account/signout.php">Sign Out</a>  
	</div>
	
	<table class="header" cellspacing="0" cellpadding="0">
		<tr>
			<td class="shrink-width"><a href="/202-account"><img src="/202-img/prosper202.png"/></a></td>
			<td>
				<table class="headline">
					<tr>
						<td>
							<? echo('<a href="/202-account">Home</a>'); 
								if ($navigation[1] == '202-account') { if ($navigation[2] == 'account.php') { echo(' &raquo; <a href="/202-account/account.php">My Account</a>'); }}	
								if ($navigation[2] == 'administration.php') { echo(' &raquo; <a href="/202-account/administration.php">Administration</a>'); }
								if ($navigation[1] == 'export202') { echo(' &raquo; <a href="/export202">Export202</a>');  }
								if ($navigation[1] == 'tracking202') { echo(' &raquo; <a href="/tracking202">Tracking202</a>');  }
							?>
						</td>
					</tr> 
				</table>
				<? if ($_SESSION['update_needed'] == true) { ?>
					<table class="alert">
						<tr>
							<td>A new version of Prosper202 is available! <a href="http://prosper202.com/apps/download/">Please update now</a>.</td>
						</tr> 
					</table>
				<? } ?>
			</td>
		</tr>
	</table>
	
	<div class="content"><? 
		
		if ($navigation[1] == 'tracking202') {  include_once($_SERVER['DOCUMENT_ROOT'] . '/tracking202/_config/top.php'); }
		if ($navigation[1] == 'tracking202api') {  include_once($_SERVER['DOCUMENT_ROOT'] . '/tracking202api/_config/top.php'); }
		
	} function template_bottom() { global $version;?></div>
	
	<div style="clear: both;"></div>
	<div class="footer">
		Thank you for marketing with <a href="http://prosper202.com">Prosper202</a>
		&middot; 
		<a href="http://prosper202.com/apps/docs/">Documentation</a>
		&middot; 
		<a href="http://prosper202.com/forum/">Forum</a>
		&middot; 
		
		<? if ($_SESSION['update_needed'] == true) { ?>
		 	<strong>Your Prosper202 <? echo $version; ?> is out of date. <a href="http://prosper202.com/apps/download/">Please update</a>.</strong>
		 <? } else { ?>
		 	Your Prosper202 <? echo $version; ?> is up to date.
		 <? } ?>
		 
		 
	<table style="margin: 20px auto 0px; text-align: left;" cellspacing="0" cellpadding="0">
		<tr valign="top">
			<td><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="/202-img/BYNCSA.png" /></a></td>
			<td style="line-height: 1.5em; padding-left: 10px; ">This work (Prosper202, Tracking202 and Export202) is licensed under a<br/> <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-Noncommercial-Share Alike 3.0 Unported License</a>.</td>
		</tr>
	</table>
		
	</div>



</div>


</body>


<? } ?>
