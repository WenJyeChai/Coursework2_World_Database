<?php

$server = "hfyyl2.mercury.nottingham.edu.my";
$username = "hfyyl2_hfywc5";
$password = "hfywc5nottingham";

$conn = new mysqli($server,$username,$password);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}


$sql = "USE hfyyl2_world";
$conn->query($sql);
$sqldisable_fkyc = "SET FOREIGN_KEY_CHECKS = 0;";
$conn->query($sqldisable_fkyc);
?>
