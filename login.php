<?php

include 'functions.php';

if (isset($_POST['username']) && isset($_POST['password'])){
	
	if (login_user($_POST['username'], $_POST['password']) == true){

		echo"YAY loged in!";
	}
}
	// else{
	// 	echo "Login Failed!";
	// }
else{
$output .= "<form class='basic-grey' name='register' method='post' action='login.php'>
		<h1>Login</h1>
			<label>
		        <span>Username</span>
		        <input id='username' type='text' name='username' placeholder='Username' />
		    </label>
		    <label>
			        <span>Password</span>
			        <input id='password' type='password' name='password' placeholder='Password' />
		    </label>
		    <label>
						<span>&nbsp;</span> 
					<input id ='submit' type='submit' class='button' value='Submit' onclick='passwordCheck(click)'/> 
			</label>
			<br />
			<br />
			<a href='register.php'>Register Here</a>
		</form>";

}
$output .= "</body>
</html>";

echo $output;

?>