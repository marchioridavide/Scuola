<?php
try{
    $conn = new PDO("mysql:host=192.168.110.80;dbname=scuola",luq,root);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected succesful";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>