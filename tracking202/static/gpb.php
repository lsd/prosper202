<? include_once($_SERVER['DOCUMENT_ROOT'] . '/202-config/connect.php'); 

//get the aff_camapaign_id

if (!$_GET['subid'] and !$_GET['sid']) die();


$click_id = $_GET['subid'];
if ($_GET['sid']) $click_id = $_GET['sid'];

if (!is_numeric($click_id)) die();

$mysql['click_id'] = mysql_real_escape_string($click_id);

//ok now update and fire the pixel tracking
$click_sql = "UPDATE 202_clicks SET click_lead='1', click_filtered='0'  WHERE click_id='".$mysql['click_id']."'";
delay_sql($click_sql);

$click_sql = "UPDATE 202_clicks_spy SET click_lead='1', click_filtered='0' WHERE click_id='".$mysql['click_id']."'";
delay_sql($click_sql);

echo $click_sql;