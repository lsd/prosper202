<? 

class AUTH {
	
	
	function logged_in() {
		
		$session_time_passed = time() - $_SESSION['session_time'];

		if  ($_SESSION['user_name'] 
		AND $_SESSION['user_id'] 
		AND ($_SESSION['session_fingerprint'] == md5('session_fingerprint' . $_SERVER['HTTP_USER_AGENT'] . session_id()))
		AND ($session_time_passed < 50000)) {
			
			$_SESSION['session_time'] = time();
			return true;
			
		} else {
			
			return false;
			
		}
	}

	function require_user() {
		
		if (AUTH::logged_in() == false) {

			 die(include_once($_SERVER['DOCUMENT_ROOT']. '/202-access-denied.php'));
		}
	}
	
	
	function set_timezone($user_timezone) {
		
		if (isset($_SESSION['user_timezone'])) { 
			$user_timezone = $_SESSION['user_timezone'];	
		}
		
		if ($user_timezone == '-12') { putenv('TZ=NZS-12NZD'); } 
		if ($user_timezone == '-11') { putenv('TZ=SST11'); }    
		if ($user_timezone == '-10') { putenv('TZ=HST10HDT'); }    
		if ($user_timezone == '-9') { putenv('TZ=AKS9AKD'); }    
		if ($user_timezone == '-8') { putenv('TZ=PST8PDT'); }    
		if ($user_timezone == '-7') { putenv('TZ=MST7MDT'); }    
		if ($user_timezone == '-6') { putenv('TZ=CST6CDT'); }    
		if ($user_timezone == '-5') { putenv('TZ=EST5EDT'); }      
		if ($user_timezone == '-4') { putenv('TZ=AST4ADT'); }    
		if ($user_timezone == '-3.5') { putenv('TZ=NST3:30NDT'); }    
		if ($user_timezone == '-3') { putenv('TZ=BST3'); }    
		if ($user_timezone == '-2') { putenv('TZ=FST2FDT'); }    
		if ($user_timezone == '0') { putenv('TZ=Europe/London'); }    
		if ($user_timezone == '1') { putenv('TZ=Europe/Paris'); }    
		if ($user_timezone == '2') { putenv('TZ=Asia/Istanbul'); }    
		if ($user_timezone == '3') { putenv('TZ=Asia/Kuwait'); }     
		if ($user_timezone == '3.5') { putenv('TZ=Asia/Tehran'); }    
		if ($user_timezone == '5.5') { putenv('TZ=IST-5:30'); }    
		if ($user_timezone == '7') { putenv('TZ=Asia/Bangkok'); }    
		if ($user_timezone == '8') { putenv('TZ=Asia/Hong_Kong'); }    
		if ($user_timezone == '9') { putenv('TZ=Asia/Tokyo'); }    
		if ($user_timezone == '9.5') { putenv('TZ=Australia/Darwin'); }    
		if ($user_timezone == '10') { putenv('TZ=Australia/Sydney'); }    
		if ($user_timezone == '12') {  putenv('TZ=Pacific/Auckland'); }     

	}
	
	
}