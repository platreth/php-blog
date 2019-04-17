<?php
 

$base = "comme980316_2fvya3";


// Uniquement pour du local

// $user = "root";
// $pass="";
// $serveur = "127.0.0.1";

// Uniquement pour la PROD !

$serveur = "91.216.107.162";
$pass = "ysnk34wz2s";
$user = "comme980316_2fvya3";
 
// connect to the database
 
$db = mysqli_connect($serveur, $user, $pass, $base);

$db->set_charset('utf8');

