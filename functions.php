<?php

include "config.php";

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_~`:,.?/';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function hash_password($u_password){
	$salt = generateRandomString();	
    $hashpassword = sha1(md5($salt . $u_password));
	return $pass = array($salt, $hashpassword); }

function login_hash_password($salt1, $u_password){
	$hashpassword = sha1(md5($salt1 . $u_password));
	return $hashpassword;
}

function register_user($username, $password, $password_2){

	if($password == $password_2){
		$e_username = mysql_real_escape_string($username);		
		$hash_pass = hash_password(mysql_real_escape_string($password));

		$sql = "SELECT username FROM login WHERE username = '" . $e_username . "' LIMIT 1";
		//echo "Checking DB";
		$query = mysql_query($sql) or trigger_error("Query failed ". mysql_error());
		//echo "There are " . mysql_num_rows($query);
		if(mysql_num_rows($query) == 1){
			//echo "Why are we in here !?!";
			$_SESSION['error'] = "Usernmame already exists";
			//echo "Username already exists in the database";
			return false;
		}
		else{
			$sql = "INSERT INTO login (`username`, `password`, `salt`)  VALUES ('".$e_username . "', '". $hash_pass[1] . "', '" . $hash_pass[0] . "');";
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			//echo "Registed user";
			return true;
		}

	}
	else{
		//echo "Are we in here?";
		$_SESSION['password_error'] = "Passwords do not match";
		$_SESSION['error'] = "Passwords do not match";
		header("Location: register.php");
		return false;
	}


}

function login_user($username, $password){	
	$e_username = mysql_real_escape_string($username);
	$sql = "SELECT salt FROM login where username = '" . $e_username . "' Limit 1";
	$query = mysql_query($sql) or trigger_error("Failed to get salt: " . mysql_error());
	$row = mysql_fetch_assoc($query);
	$salt = $row['salt'];

	$hashed_password = login_hash_password($salt, $password);



	$sql = "SELECT username FROM login WHERE username = '" . $e_username . "' AND password = '" . $hashed_password . "' Limit 1";
	$query = mysql_query($sql) or trigger_error("Failed to check passwords: " . mysql_error());
	
	
	
	if(mysql_num_rows($query) > 0){
		$row = mysql_fetch_assoc($query);
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $row['username'];
		header("Location: index.php");

	}
	else {
		echo "<br/>";
		echo "log in failed";
	}
	
}
function loggedIn(){
	if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])){
		return true;
	}
	return false;
}


?>