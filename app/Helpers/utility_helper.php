<?php

$GLOBALS['baseUrl'] = 'http://localhost:8030/';

if (!function_exists('hashPassword')) {
	function hashPassword($pass) {
		return sha1(md5($pass));
	}
}

if (!function_exists('host_url')) {
	function host_url() {
		return $GLOBALS['baseUrl'];
	}
}

if (!function_exists('header_container')) {
	function header_container() {
		return view('inc/headerContainer');
	}
}

if (!function_exists('js_container')) {
	function js_container() {
		return view('inc/jsContainer.php');
	}
}

if (!function_exists('side_bar')) {
	function side_bar() {
		return view('inc/menus.php');
	}
}

if (!function_exists('decrypt_id')) {
	function decrypt_id($id) {
		$exid = explode('.', $id);

		return $exid[1];
	}
}

if (!function_exists('generateCrpfNum')) {

	 function generateCrpfNum($id, $prefix = '0000000') {
	 	$year = date('Y');
	 	$Count = $id++;

	 	$sequence_num = str_pad($Count, strlen($prefix), $prefix, STR_PAD_LEFT);

	 	//return $year.'-'.$prefix.$Count;

	 	return $year.'-'.$sequence_num;
    }
}

if (!function_exists('generateCasfNum')) {

	 function generateCasfNum($id, $prefix = '0000000') {
	 	$year = date('Y');
	 	$Count = $id++;

	 	return $prefix. $Count;
    }
}

if (!function_exists('generateFoldername')) {

	 function generateFoldername($id) {
	 	$year = date('Y');
	 	$Num = rand(1,4000).time();

	 	return $year.'-'.$Num.'-'.$id;
    }
}

if (!function_exists('renameFile')) {

	 function renameFile($file,$crpfid){
	 	$ex = explode('.', $file);
	 	$ar = end($ex);

	 	$rand_bytes = bin2hex(random_bytes(5));

	 	$randomNum = $rand_bytes.rand(1,500).time().'-'. $crpfid;

	 	return $randomNum.'.'.strtolower($ar);

    }
}

if (!function_exists('do_upload')) {
	 function do_upload($tmpname,$path){
	 	 if (move_uploaded_file($tmpname, $path)) {
	 	 	return true;
	 	 }
	 	 return false;
    }
}

if (!function_exists('uploads_url')) {
	 function uploads_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/uploads/';
    }
}

if (!function_exists('Psefupload_url')) {
	 function Psefupload_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/PsefUploads/';
    }
}

if (!function_exists('Peafupload_url')) {
	 function Peafupload_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/PeafUploads/';
    }
}

if (!function_exists('Eccfupload_url')) {
	 function Eccfupload_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/EccfUploads/';
    }
}

if (!function_exists('Ecrfupload_url')) {
	 function Ecrfupload_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/EcrfQuotation/';
    }
}

if (!function_exists('FaafUploads_url')) {
	 function FaafUploads_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/FaafUploads/';
    }
}

if (!function_exists('FarmUploads_url')) {
	 function FarmUploads_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/FarmUploads/';
    }
}

if (!function_exists('TravelOrderUploads_url')) {
	 function TravelOrderUploads_url(){
	 	 return $GLOBALS['baseUrl'] . 'public/TravelOrderUploads/';
    }
}

if (!function_exists('CarfUploadUrl')) {
	function CarfUploadUrl(){
		 return $GLOBALS['baseUrl'] . 'public/CarfAttachments/';
   }
}


if (!function_exists('checkFileExt')) {
	 function checkFileExt($file){
	 	 $expFile = explode('.', $file); //RETURN ARRAY

	 	 $getExt = strtolower(end($expFile)); // RETURN LAST VALUE OF ARRAY

	 	 return $getExt;
    }
}

if (!function_exists('generateCode')) {
	 function generateCode(){
	  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  $rand = rand(0,9000);
	  
	  return substr(str_shuffle($data), 0, 6).substr($rand, 0, 5);
    }
}

if (!function_exists('GeneratePassword')) {
	 function GeneratePassword(){
	  $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  $passlength = 6;
	  $password = '';

	  // for($i = 0; $i < $passlength; $i++) {
	  // 	 $password .= chr(rand(33, 126));
	  // }

	  //return $password . substr(str_shuffle($str), 0, 2);

	  return substr(str_shuffle($str), 0, 7);
	  
    }
}

if (!function_exists('get_browser_name')) {
	  function get_browser_name() {
	  	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	  	
	    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
	    elseif (strpos($user_agent, 'Edge')) return 'Edge';
	    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
	    elseif (strpos($user_agent, 'Safari')) return 'Safari';
	    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
	    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
	   
	    return 'Other';
	}
}


if (!function_exists('PrintJson')) {
	  function PrintJson($json_data) {
	  	header('Content-Type: application/json');

	  	$json = json_encode($json_data, JSON_PRETTY_PRINT);
        echo "<pre>"; 
        echo $json;
        echo "</pre>";
	}
}

if (!function_exists('OpexUploads_url')) {
	function OpexUploads_url(){
		 return $GLOBALS['baseUrl'] . 'public/OpexUploads/OpexFiles/';
	}
}
?>