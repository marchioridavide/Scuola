<html>
    <head></head>
    <body>
        <form action = 'login.php' method = 'post'>
            
            <input type = 'text' placeholder = "username" name = "username">
            <input type = 'password' placeholder = "password" name = "pass">
            <input type = "hidden" name = "type" value = "log">
            <input type = "submit">
            
        </form>
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