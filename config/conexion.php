<?php
$con = new mysqli("localhost","root","","maskotapp");
if(mysqli_connect_errno())
{
	echo 'conexion fallida:',mysqli_connect_error();
	exit();
}
?>
