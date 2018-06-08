<?php

    if(isset($_GET['type']) && $_GET['type'] == "toLogb")
    {
        ob_start();
        header("Location: logBadge.php");
        ob_end_flush();
        die();
    }

?>