<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel = "stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    </head>
    <body>
        <br>
        <br>
        <div class = "container">
        <form action = '' method = 'post'>
            <br>
            
                <label class="control-label col-sm-2">Username:</label>
                <input type = 'text' placeholder = "username" name = "username" class="inputtext">
            
                <br>
            <br>
            
                <label class="control-label col-sm-2">Password:</label>
                <input type = 'password' placeholder = "password" name = "pass" class="inputtext">
            
                <input type = "hidden" name = "type" value = "log">
            
            <br>
            <br>
            
                <input type = "submit" class="sub">
            
        </form>
        </div>
            <?php
            
                include("dbController.php");
                $dbhandler = new dbcontroller();
                if (isset($_POST['type']) && $_POST['type'] == "log")
                {
                    $res = $dbhandler->login_control($_POST['username'], $_POST['pass']);
                    if($res != false)
                    {
                        session_start();
                       $_SESSION['user_logged'] = $_POST['username']; 
                        header("Location: logBadge.php");
                    }
                    else
                    {
                        echo "Username o password errata";
                    }
                }
            
            ?>
            
    </body>
</html>