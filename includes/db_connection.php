<?php 

$dbHost	= 'localhost'; 
$dbUser = 'hadeel'; 
$dbPass = 'hadeel'; 
$dbName = 'intern';

// 1. Create a Database connection 
function db_connect(){
	global $dbHost , $dbUser , $dbPass , $dbName;
	$connection = mysqli_connect($dbHost , $dbUser , $dbPass , $dbName);
	confirm_db_connect();  
	return $connection; 
}

function confirm_db_connect(){
	if (mysqli_connect_errno()){
		$msg = 'Database connection Failed: '; 
		$msg .= mysqli_connect_error(); 
		$msg .= "( " . mysqli_connect_errno() . " )"; 
		exit($msg);  
	}
}

function create_user($username, $phone, $email){
	global $db; 
	$sql    = 'INSERT INTO interns ';
    $sql    .= '(username, phone , email) '; 
    $sql    .= 'VALUES ('; 
    $sql    .= "'" . $username . "', ";
    $sql    .= "'" . $phone . "', ";
    $sql    .= "'" . $email . "');";
    $create  = mysqli_query($db, $sql);
    return $create;
}

function update_user($user){
	global $db; 
	$sql    = 'UPDATE interns SET ';
    $sql    .= "username='" . $user['username'] . "', ";
    $sql    .= "phone='" . $user['phone'] . "', ";
    $sql    .= "email='" . $user['email'] . "' ";
    $sql 	.= "WHERE id='" . $user['id'] . "'";
    $update  = mysqli_query($db, $sql);
     if ($update){
        session_destroy(); 
        header("Location: intern.php");
    }else{
        echo mysqli_error($db);
        db_disconnect($db); 
        exit; 
    }
}

function find_user($id){
	global $db;

	$sql = "SELECT * FROM interns ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;   
}
function confirm_result_set($result_set){
	if (!$result_set){
		exit("Database Query Failed"); 
	}
}
//5. Disconnect the Database 
function db_disconnect($connection){
	if(isset($connection)){
		mysqli_close($connection); 
	}
}


