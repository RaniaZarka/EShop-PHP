<?php

$db_name = 'mysql:host=localhost;dbname=shop_db;port=3307';
$user_name = 'root';
$user_password = 'root';

$conn = new PDO($db_name, $user_name, $user_password);
 

//$conn = mysqli_connect('localhost','root','root','shop_db', 3307) or die('connection failed');
?>