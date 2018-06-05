<html>
    <head></head>
    <body>
        <form action = '' method = 'post'>
            
            <input type = 'text' placeholder = "username" name = "username">
            <input type = 'password' placeholder = "password" name = "pass">
            <input type = "hidden" name = "type" value = "add">
            <input type = "submit">
            
        </form>
            <?php
            
                include("dbController.php");
                $dbhandler = new dbcontroller();
                if (isset($_POST['type']) && $_POST['type'] == "add")
                {
                    $username = $_POST['username'];
                    $pswmd5 = md5($_POST['password']);
                    if($dbhandler->register($username, $pswmd5)) echo "Register succesfull".$_POST['username'];
                }
    
            
            ?>
            
    </body>
</html>