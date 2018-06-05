<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel = "stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
                  session_start();
                  if($_SESSION['admin'] == true)
                  {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="add_account.php">Aggiungi utente<span class="sr-only">(current)</span></a>
                    </li>';
                  }
                  if(isset($_SESSION['user_logged']))
                  {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out<span class="sr-only">(current)</span></a>
                    </li>';
                  }
                ?>
              <li class="nav-item">
                <a class="nav-link" href="logBadge.php">Log badge</a>
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
                <button type="submit" class="btn btn-primary">Submit</button>
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
                        $_SESSION['user_logged'] = $res; 
                        $_SESSION['admin'] = $dbhandler->isadmin($res);
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