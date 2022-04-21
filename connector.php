<?php
error_reporting( ~E_DEPRECATED & ~E_NOTICE );
$servername = "localhost";
$username = "root";
$password = "";
		
try {
    $conn = new PDO("mysql:host=$servername;dbname=cr_book_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
	
?>