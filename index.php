<?php

include 'functions.php';

if (loggedIn()){
	echo "Welcome back "  . $_SESSION['username'];
	echo "<br />";
	
	echo "<br/>";
	echo "<a href='logout.php'><span>logout</span></a>";
}
else{
	header("Location: login.php");
}



?>