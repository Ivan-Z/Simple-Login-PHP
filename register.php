<?php

include 'functions.php';

$output .= "
<!DOCTYPE HTML>
<html>
	<title>Register</title>
	 
	<body>";


if (isset($_POST['username']) && isset($_POST['password'])){
	
	if (register_user($_POST['username'], $_POST['password'], $_POST['password_2']) == true){
		$output .= "<p> Registration successful! </br> Click <a href='login.php'>Here</a> to login</p>";


	}
	else{
		echo "Registration unsucsesful :( ";
		echo $_SESSION['error'];
		
	}
}
else{
	if (isset($_SESSION['password_error'])){
		echo $_SESSION['password_error'];
	}
	
	$output.="
	<form class='basic-grey' name='register' method='post' action='register.php'>
		<h1>Register</h1>
			<label>
		        <span>Username</span>
		        <input id='username' type='text' name='username' placeholder='Username' />
		    </label>
		    <label>
			        <span>Password</span>
			        <input id='password' type='password' name='password' placeholder='Password' />
		    </label>
		    <label>
		        <span>Re-enter Password</span>
		        <input id='password_2' type='password' name='password_2' placeholder='Password' />
		    </label>
		    <label>
						<span>&nbsp;</span> 
					<input id ='submit' type='submit' class='button' value='Submit' onclick='passwordCheck(click)'/> 
			</label>
		</form>
";
}

$output .= "</body>
</html>";

echo $output;
?>