<?php

function _token(){
	$randomToken = base64_encode(openssl_random_pseudo_bytes(32))."open ssl<br>"; 
	$_SESSION['token'] = $randomToken;
	
	return $_SESSION['token'];
}

function validate_token($requestToken){
	if( isset($_SESSION['token']) && $requestToken === $_SESSION['token'] ){ 
		unset($_SESSION['token']);
		return true;
	}
	return false; 
}


function catReturn(){
	
include 'connector.php';

	$sql7 = "SELECT * FROM `category` ";
	$res7 = $conn->prepare($sql7);
	$res7->execute();
	$rows = $res7->fetchAll();
	$categoryArray = array();
	foreach ($rows as $value){
		$categoryArray[$value["CatId"]] = $value["CatName"];
	}

	return $categoryArray;
}


function storeReturn(){
	
	include 'connector.php';
	
	$ids = $_SESSION['User_id'];

		$sql7 = "SELECT * FROM `store` WHERE `UserId`='$ids'";
		$res7 = $conn->prepare($sql7);
		$res7->execute();
		$rows = $res7->fetchAll();
		$StoreArray = array();
		foreach ($rows as $value){
			$StoreArray[$value["StoreId"]] = $value["StoreName"];
		}
	
		return $StoreArray;
	}
	
	
	


function checkErrorInput($input,$min){
$error = FALSE;
	if (empty($input)) {
			$error = TRUE;
		} else if (strlen($input) < $min) {
			$error = TRUE;
		} else if (!preg_match("/^[a-zA-Z ]+$/",$input)) {
			$error = TRUE;
		}
		
	return $error;
}

function emailVerify($email){
 $error = FALSE;
	if(empty($email)){
			$error = TRUE;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = TRUE;
		}
		return $error;
}

function checkTwoString($f,$l){
	$f = strtolower($f);
	$l = strtolower($l);
	
	return strcmp($f,$l);
	
}

?>
