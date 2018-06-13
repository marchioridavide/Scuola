<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel = "stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <?php 
            session_start();
            //if(!isset($_SERVER['https'])) header("Location: https://127.0.0.1/Scuola/login.php");
            if(isset($_SESSION['user_logged'])) header("Location: logBadge.php");
        ?>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                   <li class="nav-item active">
                        <a class="nav-link" href="login.php">Log in</a>
                   </li>
               </ul>
            </div>
        </nav>
        
        <div class="login-form">
            <form action = '' method = 'post'>
                <div class="from-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>

                <input type = "hidden" name = "type" value = "log">
                <button type="submit" class="btn btn-primary" value = "Log in">Submit</button>
            </form>
        </div>
            <?php
            
                include("dbController.php");
                $dbhandler = new dbcontroller();
                if (isset($_POST['type']) && $_POST['type'] == "log")
                {
                    $pasw = $_POST['pass'];
                    echo $pass;
                    echo $POST['username'];
                    $res = $dbhandler->login_control($_POST['username'], $_POST['pass']);
                    if($res != false)
                    {
                        session_start();
                        $_SESSION['user_logged'] = $res; 
                        $_SESSION['admin'] = $dbhandler->isadmin($res);
                        showPopUp();
                    }
                    else
                    {
                        echo "<script language='javascript'>
			alert('Username o password errata');</script>";
                    }
                }
                function showPopUp()
                {
                    echo "<script type = 'text/javascript'>
                    $(document).ready(function(){
                    $('#exampleModalCenter').modal('show');
                    });
                    </script>";
                }
            ?>
        
            <div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLongTitle'>Success</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p>Login eseguito correttamente</p>
                    </div>
                    <div class='modal-footer'>
                        <form action = "redirect.php" method = "get">
                            <input type="hidden" name = "type" value = "toLogb">
                            <button type = "submit" class='btn btn-primary'>Ok</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        
    </body>
</html>