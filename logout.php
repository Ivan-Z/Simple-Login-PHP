<?php

	unset($_SESSION['loggedin']);
	unset($_SESSION['username']);
	header("Location: login.php");

?>