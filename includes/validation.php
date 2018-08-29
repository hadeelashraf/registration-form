<?php
foreach ($_POST as $key => $value) {
	$value = trim($value);
	if (empty($value) && in_array("$key", $required)){
		$flag = 1; 
		$missing[] = $key;
		$$key = ''; 
	}else{
		$$key = $value; 
	}
}
if (!empty($email)){
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$flag = 1; 
		$errors[] ='email';
	}
}
if(!preg_match("/^[a-zA-Z0-9 ]*$/", $username)){
	$flag = 1; 
	$errors[] = 'username'; 
}
if(!preg_match("/(01)[0125]\d{8}$/", $phone)){
	$flag = 1; 
	$errors[] = 'phone'; 
}
