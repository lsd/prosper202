<? include_once($_SERVER['DOCUMENT_ROOT'] . '/202-config/connect.php'); 





AUTH::require_user();

//set no time limit on this
set_time_limit(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

	
	if ($_POST['token'] != $_SESSION['token']){ $error['token'] = '<div class="error">You must use our forms to submit data.</div';  }
	
	if ($_POST['network'] == '') { $error['network'] = '<div class="error">Choose a network</div>'; }	
	if ($_FILES['csv']['error'] == 4) { $error['csv'] = '<div class="error">You must upload a  .csv file</div>'; }	
	
	$ext = getFileExtension($_FILES['csv']['name']);
	$ext = strtolower($ext);
	if ($ext != "csv") { $error['csv'] = '<div class="error">You must upload a  .csv file</div>'; }	
	
	//check filesize
	$upload_max_filesize = ini_get('upload_max_filesize');
	$upload_max_filesize = str_replace('M','',$upload_max_filesize);
	
	$post_max_size = ini_get('post_max_size');
	$post_max_size = str_replace('M','',$post_max_size);
	
	if ($upload_max_filesize > $post_max_size) { 
		$post_max_size = $upload_max_filesize;
	}
	
	$post_max_size = $post_max_size * 1048576;
	//if ($_FILES['csv']['size'] > $post_max_size) {  $error['size'] = '<div class="error">The file you tried to upload was to large, your max file size upload is: '.ini_get('post_max_size').'.  You may increase this value by changing the post_max_size variable in your php.ini</div>'; }	
	
	//if the file size is not equal to anything the file was to big and couldn't even set.
	//if ($_FILES['csv']['size'] == '') {  $error['size'] = '<div class="error">The file you tried to upload was to large or you uploaded no file at all, your max file size upload is: '.ini_get('post_max_size').'. <br/> You may increase this value by changing the post_max_size variable in your php.ini</div>'; }	
	
	if (!$error) { 
		//if no error start a new export_session_id for reference
		$mysql['export_session_time'] = time();
		$mysql['export_session_ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
		
		$export_session_sql = "INSERT INTO 	202_export_sessions
							      SET 			export_session_time='".$mysql['export_session_time']."',
							      				export_session_ip='".$mysql['export_session_ip']."'";
		$export_session_result = _mysql_query($export_session_sql);
		$export_session_id = mysql_insert_id();
		$mysql['export_session_id'] = mysql_real_escape_string($export_session_id);
		
		
		//create a public session_id now
		$alphanum = "abdefghijklmnopqrstuvwxyz1234567890";     
		$export_session_id_public = substr(str_shuffle($alphanum), 0, 5) . $export_session_id . substr(str_shuffle($alphanum), 0, 5); 
		$mysql['export_session_id_public'] = mysql_real_escape_string($export_session_id_public);
		
		//update rowIm
		$export_session_sql = "UPDATE 202_export_sessions SET export_session_id_public='".$mysql['export_session_id_public']."' WHERE export_session_id='".$mysql['export_session_id']."'";
		$export_session_result = _mysql_query($export_session_sql);
		
		
		//open the tmp file, that was uploaded, the csv
		$tmp_name = $_FILES['csv']['tmp_name'];
		$handle = fopen($tmp_name, "rb"); 
		

		//this counter, will help us determine the first row of the array
		$x = 0;
		while ((($row = fgetcsv($handle, 100000, "\t")) !== FALSE) and (!$error)) {
			
			ob_flush();
			flush();
			
			//clean out all those BS characters, with CleanString for each value
			foreach( $row as $key => $value ) { $row[$key] = trim(cleanString( $value )); }

			if ($fix_google == true) {  
				
				$row[22] = $row[21];
				$row[21] = $row[20];
				$row[20] = $row[19];
				$row[19] = $row[18];
				$row[18] = $row[17];
				$row[17] = $row[16];
				$row[16] = $row[15];
				$row[15] = $row[14];
				$row[14] = $row[13];
				$row[13] = $row[12];
				$row[12] = $row[11];
				$row[11] = $row[10];
				$row[10] = $row[9];
				
			}
			
			//if this is the first row
			$x++;
			if ($x == 1) {
				
		
				//check to make sure the fields match up, if Y! submited, make sure its in the correct Y! syntax
				if ($_POST['network'] == 'yahoo') { 
					
					   if ($row[0] != 'Campaign Name') { $error['type'] = 1; }
					   if ($row[1] != 'Ad Group Name') {  $error['type'] = 1; }
					   if ($row[2] != 'Component Type') {  $error['type'] = 1; }
					   if ($row[3] != 'Component Status') {  $error['type'] = 1; }
					   if ($row[4] != 'Display Status') {  $error['type'] = 1;  }
					   if ($row[5] != 'Keyword') {  $error['type'] = 1;  }
					   if ($row[6] != 'Keyword Alt Text') {  $error['type'] = 1; }
					   if ($row[7] != 'Keyword Custom URL') {  $error['type'] = 1; } 
					   if ($row[8] != 'Sponsored Search Bid (USD)') {  $error['type'] = 1; } 
					   if ($row[9] != 'Sponsored Search Bid Limit (USD)') {  $error['type'] = 1; } 
					   if ($row[10] != 'Sponsored Search Min Bid (USD)') {  $error['type'] = 1; } 
					   if ($row[11] != 'Sponsored Search Status') {  $error['type'] = 1; } 
					   if ($row[12] != 'Match Type') {  $error['type'] = 1; } 
					   if ($row[13] != 'Content Match Bid (USD)') {  $error['type'] = 1; } 
					   if ($row[14] != 'Content Match Bid Limit (USD)') {  $error['type'] = 1; } 
					   if ($row[15] != 'Content Match Min Bid (USD)') {  $error['type'] = 1; } 
					   if ($row[16] != 'Content Match Status') {  $error['type'] = 1; } 
					   if ($row[17] != 'Ad Name') {  $error['type'] = 1; } 
					   if ($row[18] != 'Ad Title') {  $error['type'] = 1; } 
					   if ($row[19] != 'Ad Short Description') {  $error['type'] = 1; } 
					   if ($row[20] != 'Ad Long Description') {  $error['type'] = 1; } 
					   if ($row[21] != 'Display URL') {  $error['type'] = 1; } 
					   if ($row[22] != 'Destination URL') {  $error['type'] = 1; } 
					   if ($row[23] != 'Watch List') {  $error['type'] = 1; }  
					   if ($row[24] != 'Campaign ID') {  $error['type'] = 1; } 
					   if ($row[25] != 'Campaign Description') {  $error['type'] = 1; } 
					   if ($row[26] != 'Campaign Start Date') {  $error['type'] = 1; } 
					   if ($row[27] != 'Campaign End Date') {  $error['type'] = 1; } 
					   if ($row[28] != 'Ad Group ID') {  $error['type'] = 1; } 
					   if ($row[29] != 'Ad Group: Optimize Ad Display') {  $error['type'] = 1; } 
					   if ($row[30] != 'Ad ID') {  $error['type'] = 1; } 
					   if ($row[31] != 'Keyword ID') { $error['type'] = 1; } 

					   
				} elseif ($_POST['network'] == 'google') {
					
					if ($row[9] != 'Website') { $fix_google = true; }
					
					if ($fix_google == true) { 
				
							$row[22] = $row[21];
							$row[21] = $row[20];
							$row[20] = $row[19];
							$row[19] = $row[18];
							$row[18] = $row[17];
							$row[17] = $row[16];
							$row[16] = $row[15];
							$row[15] = $row[14];
							$row[14] = $row[13];
							$row[13] = $row[12];
							$row[12] = $row[11];
							$row[11] = $row[10];
							$row[10] = $row[9];
							$row[9] = 'Website';
						}
				
					   if ($row[0] != 'Campaign') { $error['type'] = 1; }
					   if ($row[1] != 'Campaign Daily Budget') {  $error['type'] = 1; }
					   if ($row[2] != 'Ad Group') {  $error['type'] = 1; }
					   if ($row[3] != 'Max CPC') {  $error['type'] = 1; }
					   if ($row[4] != 'Max Content CPC') {  $error['type'] = 1;  }
					   if ($row[5] != 'Placement Max CPC') {  $error['type'] = 1; }
					   if ($row[6] != 'Max CPM') {  $error['type'] = 1; }
					   if ($row[7] != 'Max CPA') {  $error['type'] = 1; }
					   if ($row[8] != 'Keyword') {  $error['type'] = 1; } 
					   if ($row[9] != 'Website') {  $error['type'] = 1; } 
					   if ($row[10] != 'Keyword Type') {  $error['type'] = 1; } 
					   if ($row[11] != 'Min CPC') {  $error['type'] = 1; } 
					   if ($row[12] != 'Headline') {  $error['type'] = 1; } 
					   if ($row[13] != 'Description Line 1') {  $error['type'] = 1; } 
					   if ($row[14] != 'Description Line 2') {  $error['type'] = 1; } 
					   if ($row[15] != 'Display URL') {  $error['type'] = 1; } 
					   if ($row[16] != 'Destination URL') {  $error['type'] = 1; } 
					   if ($row[17] != 'Campaign Status') {  $error['type'] = 1; } 
					   if ($row[18] != 'AdGroup Status') {  $error['type'] = 1; } 
					   if ($row[19] != 'Creative Status') {  $error['type'] = 1; } 
					   if ($row[20] != 'Keyword Status') {  $error['type'] = 1; } 
					   //if ($row[21] != 'Suggested Changes') {  $error['type'] = 1; } 
					   //if ($row[22] != 'Comment') {  $error['type'] = 1; } 
					   
				}
				

				if ($error['type'] == 1) { $error['type'] = '<div class="error">The .csv file you uploaded diddn\'t match the network you selected</div>'; }

			} 

			if (!$error) { 
			
				/* YAAAHHHOOOOOOOOO */ // AND make sure compoenent status is not deleted
				if (($_POST['network'] == 'yahoo') and ($row[3] != 'Deleted')) { 
					
					//row14, campaign y/n
					//row15, adgroup y/n
					//row16, textad y/n
					//row 17, keyword y/n
					 
					//if campaign
					if ($row[2] == 'Campaign') { 
					
						$export_campaign_name = $row[0];
						$export_campaign_status = $row[3];
						
						if ($export_campaign_status == 'On') { 
							$export_campaign_status = 1;
						} else {
							$export_campaign_status = 0;	
						}
						
						$mysql['export_campaign_name'] = mysql_real_escape_string($export_campaign_name);
						$mysql['export_campaign_status'] = mysql_real_escape_string($export_campaign_status);
					
						$export_campaign_sql = "INSERT INTO  202_export_campaigns
										  		    SET			 export_session_id='".$mysql['export_session_id']."',
										  		    				 export_campaign_name='".$mysql['export_campaign_name']."',
										  		    				 export_campaign_status='".$mysql['export_campaign_status']."'";
						$export_campaign_result = _mysql_query($export_campaign_sql); //($export_campaign_sql);
						$export_campaign_id = mysql_insert_id();
	
						$mysql['export_campaign_id'] = mysql_real_escape_string($export_campaign_id);		
						
		
					}
					
	
					
					
					//if adgroup
					if ($row[2] == 'Ad Group') { 
										
						
						$export_adgroup_name = $row[1];
						$export_adgroup_status = $row[3];
						$export_adgroup_max_search_cpc = $row[8];
						$export_adgroup_max_content_cpc = $row[13];
						$export_adgroup_search = $row[11];
						$export_adgroup_content = $row[16];
						
						if ($export_adgroup_status == 'On') { 
							$export_adgroup_status = 1;
						} else {
							$export_adgroup_status =0;	
						}
						
						if ($export_adgroup_search == 'On') { 
							$export_adgroup_search = 1;
						} else {
							$export_adgroup_search = 0;	
						}
						
						if ($export_adgroup_content == 'On') { 
							$export_adgroup_content = 1;
						} else {
							$export_adgroup_content = 0;	
						}
						
						
						$mysql['export_adgroup_name'] = mysql_real_escape_string($export_adgroup_name);
						$mysql['export_adgroup_max_search_cpc'] = mysql_real_escape_string($export_adgroup_max_search_cpc);
						$mysql['export_adgroup_max_content_cpc'] = mysql_real_escape_string($export_adgroup_max_content_cpc);
						$mysql['export_adgroup_status'] = mysql_real_escape_string($export_adgroup_status);
						$mysql['export_adgroup_search'] = mysql_real_escape_string($export_adgroup_search);
						$mysql['export_adgroup_content'] = mysql_real_escape_string($export_adgroup_content);
						
						
						$export_adgroup_sql = "   INSERT INTO  202_export_adgroups
										  		    SET			 export_session_id='".$mysql['export_session_id']."',
										  		    				 export_campaign_id='".$mysql['export_campaign_id']."',
										  		    				 export_adgroup_name='".$mysql['export_adgroup_name']."',
										  		    				 export_adgroup_max_search_cpc='".$mysql['export_adgroup_max_search_cpc']."',
										  		    				 export_adgroup_max_content_cpc='".$mysql['export_adgroup_max_content_cpc']."',
										  		    				 export_adgroup_status='".$mysql['export_adgroup_status']."',
										  		    				 export_adgroup_search='".$mysql['export_adgroup_search']."',
										  		    				 export_adgroup_content='".$mysql['export_adgroup_content']."'";
						$export_adgroup_result = _mysql_query($export_adgroup_sql); //($export_adgroup_sql);
						$export_adgroup_id = mysql_insert_id();
	
						$mysql['export_adgroup_id'] = mysql_real_escape_string($export_adgroup_id);	 	 	
					}
					
					
					//if textad
					if ($row[2] == 'Ad') { 
					    
						$export_textad_status = $row[3];
						
						$export_textad_title = $row[18];
						$export_textad_description_full = $row[19];
						$export_textad_display_url = $row[21];
						$export_textad_destination_url = $row[22];

						if ($export_textad_status == 'On') { 
							$export_textad_status = 1;
						} else {
							$export_textad_status =0;	
						}
						
						$mysql['export_textad_title'] = mysql_real_escape_string($export_textad_title);
						$mysql['export_textad_description_full'] = mysql_real_escape_string($export_textad_description_full);
						$mysql['export_textad_display_url'] = mysql_real_escape_string($export_textad_display_url);
						$mysql['export_textad_destination_url'] = mysql_real_escape_string($export_textad_destination_url);
						$mysql['export_textad_status'] = mysql_real_escape_string($export_textad_status);
	
						$export_textad_sql = "    INSERT INTO  202_export_textads
										  		    SET			 export_session_id='".$mysql['export_session_id']."',
										  		    				 export_campaign_id='".$mysql['export_campaign_id']."',
										  		    				 export_adgroup_id='".$mysql['export_adgroup_id']."',
										  		    				 export_textad_title='".$mysql['export_textad_title']."',
										  		    				 export_textad_description_full='".$mysql['export_textad_description_full']."',
										  		    				 export_textad_display_url='".$mysql['export_textad_display_url']."',
										  		    				 export_textad_destination_url='".$mysql['export_textad_destination_url']."',
										  		    				 export_textad_status='".$mysql['export_textad_status']."'";
						$export_textad_result = _mysql_query($export_textad_sql); //($export_textad_sql);
						$export_textad_id = mysql_insert_id();
	
						$mysql['export_textad_id'] = mysql_real_escape_string($export_textad_id);	
	
						
					}
					
					
					//if keyword
					if (($row[2] == 'Keyword') or ($row[2] == 'Ad Group Excluded Word')) { 
					
						
						$export_keyword_status = $row[3];
						$export_keyword = $row[5];
						$export_keyword_destination_url = $row[7];
						$export_keyword_max_cpc = $row[8];
						$export_keyword_match = $row[12];
						
						if ($export_keyword_max_cpc == 'Default') {
							$export_keyword_max_cpc = 0;	
						}
						
						if ($export_keyword_match == 'Advanced') {
							$export_keyword_match = 'broad';	
						} elseif ($export_keyword_match == 'Simple') {
							$export_keyword_match = 'exact';		
						} elseif ($row[2] == 'Ad Group Excluded Word') {
							$export_keyword_match='negative';	
						}
						
						if ($export_keyword_status == 'On') { 
							$export_keyword_status = 1;
						} else {
							$export_keyword_status =0;	
						}
						
						$mysql['export_keyword_max_cpc'] = mysql_real_escape_string($export_keyword_max_cpc);
						$mysql['export_keyword'] = mysql_real_escape_string($export_keyword);
						$mysql['export_keyword_match'] = mysql_real_escape_string($export_keyword_match);
						$mysql['export_keyword_destination_url'] = mysql_real_escape_string($export_keyword_destination_url);
						$mysql['export_keyword_status'] = mysql_real_escape_string($export_keyword_status);
	
						$export_keyword_sql = "   INSERT INTO   	 202_export_keywords
											  		    SET			 export_session_id='".$mysql['export_session_id']."',
											  		    				 export_campaign_id='".$mysql['export_campaign_id']."',
											  		    				 export_adgroup_id='".$mysql['export_adgroup_id']."',
											  		    				 export_keyword_max_cpc='".$mysql['export_keyword_max_cpc']."',
											  		    				 export_keyword='".$mysql['export_keyword']."',
											  		    				 export_keyword_match='".$mysql['export_keyword_match']."',
											  		    				 export_keyword_destination_url='".$mysql['export_keyword_destination_url']."',
											  		    				 export_keyword_status='".$mysql['export_keyword_status']."'";
						$export_keyword_result = _mysql_query($export_keyword_sql); //($export_keyword_sql);
						$export_keyword_id = mysql_insert_id();
						
						
						$mysql['export_keyword_id'] = mysql_real_escape_string($export_keyword_id);	
	
					}
				 
				
				}
	
				
				
				
				
				
				
				
				
				
				/* GOOOOGGGGLEEEE */
				if ($_POST['network'] == 'google') { 
					
					//row14, campaign y/n
					//row15, adgroup y/n
					//row16, textad y/n
					//row 17, keyword y/n
					
					//if campaign
					if (($x != 1) and ($row[17] != '') and ($row[18] == '')) { 
					
						$export_campaign_name = $row[0];
						$export_campaign_daily_budget = $row[1];
						$export_campaign_status = $row[17];
						
						if ($export_campaign_status == 'Paused') { 
							$export_campaign_status = 0;
						} else {
							$export_campaign_status =1;	
						}

						
						
						$mysql['export_campaign_name'] = mysql_real_escape_string($export_campaign_name);
						$mysql['export_campaign_daily_budget'] = mysql_real_escape_string($export_campaign_daily_budget);
						$mysql['export_campaign_status'] = mysql_real_escape_string($export_campaign_status);
					
						$export_campaign_sql = "INSERT INTO  202_export_campaigns
										  		    SET			 export_session_id='".$mysql['export_session_id']."',
										  		    				 export_campaign_name='".$mysql['export_campaign_name']."',
										  		    				 export_campaign_daily_budget='".$mysql['export_campaign_daily_budget']."',
										  		    				 export_campaign_status='".$mysql['export_campaign_status']."'";
						$export_campaign_result = _mysql_query($export_campaign_sql); //($export_campaign_sql);
						$export_campaign_id = mysql_insert_id();

	
						$mysql['export_campaign_id'] = mysql_real_escape_string($export_campaign_id);		 	
					}
					
					
					
					//if adgroup
					if (($x != 1) and ($row[18] != '') and ($row[12] == '') and ($row[8] == '')) { 
					
						$export_adgroup_name = $row[2];
						$export_adgroup_max_search_cpc = $row[3];
						$export_adgroup_max_content_cpc = $row[4];
						$export_adgroup_status = $row[18];
						
						if ($export_adgroup_status == 'Active') { 
							$export_adgroup_status = 1;
						} else {
							$export_adgroup_status =0;	
						}
						
						//is search enabled?
						if ((is_numeric($export_adgroup_max_search_cpc)) and  ($export_adgroup_max_search_cpc > 0)) { 
							$export_adgroup_search = 1;
						} else {
							$export_adgroup_search =0;	
						}
						
						//is content enabled?
						if ((is_numeric($export_adgroup_max_content_cpc)) and  ($export_adgroup_max_content_cpc > 0)) { 
							$export_adgroup_content = 1;
						} else {
							$export_adgroup_content =0;	
						}
						
						
						$mysql['export_adgroup_name'] = mysql_real_escape_string($export_adgroup_name);
						$mysql['export_adgroup_max_search_cpc'] = mysql_real_escape_string($export_adgroup_max_search_cpc);
						$mysql['export_adgroup_max_content_cpc'] = mysql_real_escape_string($export_adgroup_max_content_cpc);
						$mysql['export_adgroup_status'] = mysql_real_escape_string($export_adgroup_status);
						$mysql['export_adgroup_search'] = mysql_real_escape_string($export_adgroup_search);
						$mysql['export_adgroup_content'] = mysql_real_escape_string($export_adgroup_content);
						
						
						$export_adgroup_sql = "   INSERT INTO  202_export_adgroups
										  		    SET			 export_session_id='".$mysql['export_session_id']."',
										  		    				 export_campaign_id='".$mysql['export_campaign_id']."',
										  		    				 export_adgroup_name='".$mysql['export_adgroup_name']."',
										  		    				 export_adgroup_max_search_cpc='".$mysql['export_adgroup_max_search_cpc']."',
										  		    				 export_adgroup_max_content_cpc='".$mysql['export_adgroup_max_content_cpc']."',
										  		    				 export_adgroup_status='".$mysql['export_adgroup_status']."',
										  		    				 export_adgroup_search='".$mysql['export_adgroup_search']."',
										  		    				 export_adgroup_content='".$mysql['export_adgroup_content']."'";
						$export_adgroup_result = _mysql_query($export_adgroup_sql); //($export_adgroup_sql);
						$export_adgroup_id = mysql_insert_id();
						
						$mysql['export_adgroup_id'] = mysql_real_escape_string($export_adgroup_id);		 	
					}
					
					
					//if textad
					if (($x != 1) and ($row[19] != '')) { 
					
						$export_textad_name = $row[12];
						$export_textad_title = $row[12];
						$export_textad_description_line1 = $row[13];
						$export_textad_description_line2 = $row[14];
						$export_textad_display_url = $row[15];
						$export_textad_destination_url = $row[16];
						$export_textad_status = $row[19];
						
						if ($export_textad_status == 'Paused') { 
							$export_textad_status = 0;
						} else {
							$export_textad_status =1;	
						}
						
						$mysql['export_textad_name'] = mysql_real_escape_string($export_textad_name);
						$mysql['export_textad_title'] = mysql_real_escape_string($export_textad_title);
						$mysql['export_textad_description_full'] = mysql_real_escape_string($export_textad_description_full);
						$mysql['export_textad_description_line1'] = mysql_real_escape_string($export_textad_description_line1);
						$mysql['export_textad_description_line2'] = mysql_real_escape_string($export_textad_description_line2);
						$mysql['export_textad_display_url'] = mysql_real_escape_string($export_textad_display_url);
						$mysql['export_textad_destination_url'] = mysql_real_escape_string($export_textad_destination_url);
						$mysql['export_textad_status'] = mysql_real_escape_string($export_textad_status);
	
						$export_textad_sql = "   INSERT INTO  202_export_textads
										  		    SET			 export_session_id='".$mysql['export_session_id']."',
										  		    				 export_campaign_id='".$mysql['export_campaign_id']."',
										  		    				 export_adgroup_id='".$mysql['export_adgroup_id']."',
										  		    				 export_textad_name='".$mysql['export_textad_name']."',
										  		    				 export_textad_title='".$mysql['export_textad_title']."',
										  		    				 export_textad_description_full='".$mysql['export_textad_description_full']."',
										  		    				 export_textad_description_line1='".$mysql['export_textad_description_line1']."',
										  		    				 export_textad_description_line2='".$mysql['export_textad_description_line2']."',
										  		    				 export_textad_display_url='".$mysql['export_textad_display_url']."',
										  		    				 export_textad_destination_url='".$mysql['export_textad_destination_url']."',
										  		    				 export_textad_status='".$mysql['export_textad_status']."'";
						$export_textad_result = _mysql_query($export_textad_sql); //($export_textad_sql);
						$export_textad_id = mysql_insert_id();
	
						$mysql['export_textad_id'] = mysql_real_escape_string($export_textad_id);	
	 	
					}
					
					
					//if keyword
					if (($x != 1) and (($row[20] != '') or ($row[10] == 'Negative Broad') or ($row[10] == 'Campaign Negative Broad'))) {  
					
						$export_keyword_max_cpc = $row[3];
						$export_keyword = $row[8];
						$export_keyword_match = $row[10];
						$export_keyword_destination_url = ($row[16]);
						$export_keyword_status = $row[20];
						
						if (($export_keyword_match == 'Negative Broad') or ($export_keyword_match == 'Campaign Negative Broad')) {
							
							//if the keyword is set to the campaign leve, remove the adgroup_id, so it sets to just the campaign
							if ($export_keyword_match == 'Campaign Negative Broad') {
								$export_adgroup_id = 0;
								$mysql['export_adgroup_id'] = mysql_real_escape_string($export_adgroup_id);
							}
							
							$export_keyword_match = 'negative';	
						}
						
						if ($export_keyword_status == 'Paused') { 
							$export_keyword_status = 0;
						} else {
							$export_keyword_status =1;	
						}
						
						$mysql['export_keyword_max_cpc'] = mysql_real_escape_string($export_keyword_max_cpc);
						$mysql['export_keyword'] = mysql_real_escape_string($export_keyword);
						$mysql['export_keyword_match'] = mysql_real_escape_string($export_keyword_match);
						$mysql['export_keyword_destination_url'] = mysql_real_escape_string($export_keyword_destination_url);
						$mysql['export_keyword_status'] = mysql_real_escape_string($export_keyword_status);
	
						$export_keyword_sql = "   INSERT INTO   	 202_export_keywords
											  		    SET			 export_session_id='".$mysql['export_session_id']."',
											  		    				 export_campaign_id='".$mysql['export_campaign_id']."',
											  		    				 export_adgroup_id='".$mysql['export_adgroup_id']."',
											  		    				 export_keyword_max_cpc='".$mysql['export_keyword_max_cpc']."',
											  		    				 export_keyword='".$mysql['export_keyword']."',
											  		    				 export_keyword_match='".$mysql['export_keyword_match']."',
											  		    				 export_keyword_destination_url='".$mysql['export_keyword_destination_url']."',
											  		    				 export_keyword_status='".$mysql['export_keyword_status']."'";
						$export_keyword_result = _mysql_query($export_keyword_sql); //($export_keyword_sql);
						$export_keyword_id = mysql_insert_id();
						
						$mysql['export_keyword_id'] = mysql_real_escape_string($export_keyword_id);	
	
					}
				 
				
				}
			
			}

			
			
		}

		fclose($handle); 
		
		if (!$error) { 
			header('location: http://'.$_SERVER['SERVER_NAME'].'/export202/export.php?id='.$export_session_id_public);
			
			?><script type="text/javascript">
					window.location ='<? echo '/export202/export.php?id='.$export_session_id_public; ?>';
			    </script><?
					
		}
		
	 } 
}

template_top('Export202',NULL,NULL,NULL); 

include_once($_SERVER['DOCUMENT_ROOT'] . '/export202/toolbar.php');

template_bottom(); 
