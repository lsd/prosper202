<div class="info">
	<h2>Convert and export PPC campaigns or entire accounts between the big 3 PPC networks. </h2>
</div>
<div class="info">
	<form enctype="multipart/form-data" action="/export202/" method="post">
		<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />  
		<? if ($error) { ?>
			<div class="warning"><div><h3>There were errors with your submission.</h3></div></div>
		<? } ?>
		<table cellspacing="0" cellpadding="10" class="csv-input">
			<? if ($error['size']) { ?>
				<tr>
					<td colspan="5"><? echo $error['size']; ?></td>
				</tr>
			<? } ?>
			<tr>
				<td><strong>#1 - Upload Yahoo SEM or Adwords .CSV File</strong></td>
				<td rowspan="2"><br/></td>
				<td><strong>#2 - This .CSV File Is From</strong></td>
				<td rowspan="2"><br/></td>
				<td><strong>#3 - Export202 It!</strong></td>
			</tr>
			<tr>
				<td><input type="file" class="csv-file" name="csv" value="<? echo $_POST['csv']; ?>"/> <?  if (!$error['size']) { echo $error['csv']; } ?></td>
				<td>
					<input type="radio"  class="csv-radio"name="network" <? if ($_POST['network'] == 'yahoo') { echo ' CHECKED '; } ?>value="yahoo"> Yahoo  Search Marketing<br/>
					<input type="radio" class="csv-radio" name="network" <? if ($_POST['network'] == 'google') { echo ' CHECKED '; } ?>value="google"> or Google Adwords<br/>
					<? if (!$error['size']) { echo $error['network'] . $error['type']; } ?>
				</td>
				<td><? if (!$error['size']) {  echo $error['token']; } ?> <input class="csv-submit" type="submit" value="Start Conversion"></td>
			</tr>	
		</table>
	</form>
</div>