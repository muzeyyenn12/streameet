<?php
$host = "localhost"; 
$veritabani_adi = "projeeee";
$kullanici_adi = "root";
$sifre = "";

try {
	$connection = new PDO("mysql:host=$host;dbname=$veritabani_adi", "$kullanici_adi", "$sifre");
	
} catch ( PDOException $e ){
	print $e->getMessage();
}
?>