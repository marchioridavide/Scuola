<?php
    require_once("dbController.php");
    $dbhandle = new dbcontroller();

    $idStud = $_POST["idstudente"];
    $result = $dbhandle->UpdateGiustifica($idStud);
?>