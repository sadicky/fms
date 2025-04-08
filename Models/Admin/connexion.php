<?php
function getConnection()
{
	$db = new PDO("mysql:host=localhost;dbname=fms", "root", "");
	// $db = new PDO("mysql:host=sql308.infinityfree.com;dbname=if0_36839138_fms", "if0_36839138", "sadicky123");
	return $db;
}
