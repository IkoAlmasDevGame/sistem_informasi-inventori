<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
$dbname = "sistem_inventori";
$config = mysqli_connect("localhost", "root", "", $dbname);

try {
    $konfigs = new PDO("mysql:host=localhost;dbname=$dbname", "root", "");
}catch(PDOException $e){
    die("Database gagal : ".$e->getMessage());
}
?>