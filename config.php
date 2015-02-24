 <?php



session_start();
include 'header.php'; 

$_SESSION['loggedin'] = false;

$output = "";

mysql_connect('localhost', 'root', '') or trigger_error("Unable to connect to mySql" , mysql_error());
mysql_select_db('List_share') or trigger_error("Unable to connect to List Share DB", mysql_error());





 ?>

