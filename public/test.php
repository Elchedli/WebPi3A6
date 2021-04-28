<?php
$user = 'root';
$pass = '';
$ds = 'spirity';
$db = new PDO("mysql:dbname=$ds;host=localhost",$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


$resultats = $db->query("SELECT contenu_msg,sender FROM message ORDER BY datetemps_msg DESC LIMIT 20");
$messages = $resultats->fetchAll();

var_dump($messages);