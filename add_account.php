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
                    echo '<li class="nav-item active">
                    <a class="nav-link" href="add_account.php">Aggiungi utente<span class="sr-only">(current)</span></a>
                    </li>';
                  }
                  if(isset($_SESSION['user_logged']))
                  {
                    echo '<li class="nav-item   ">
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
        <?php
            session_start();    
            if(!isset($_SESSION['user_logged']) || $_SESSION['admin']!=true) header("Location: login.php");
        ?>
        <div class = "addAc-form">
        <form action = '' method = 'post'>
            
            <div class="form-group">
                <input type = 'text' placeholder = "username" name = "username" class="form-control">
            </div>
            
            <div class="form-group">
                <input type = 'password' placeholder = "password" name = "password" class="form-control" id="exampleInputPassword1">
            </div>
            
            
            <input type = "hidden" name = "type" value = "add">
            
            <div class="form-group">
                <?php
                    include("dbController.php");
                    $dbhandler = new dbcontroller();
                    $query = "select * from prof";
                    $res = $dbhandler->runQuery($query);
                    echo "<select name = 'prof' class='form-control'><option></option>";
                    while($row = $res->fetch())
                    {
                        echo "<option>".$row['idprof'].", " . $row['Nome'].", ".$row['Cognome'].", ".$row['DataDiNascita']."</option>";
                    }

                    echo "</select>";

                ?>
            </div>
            
            <div class="form-group">
                Admin: <input name='admin' type='checkbox' value />
            </div>
            
            <div class="form-group">
                <input type = "submit" class="btn btn-primary">
            </div>
            
        </form>
        </div>
            <?php
            
                if (isset($_POST['type']) && $_POST['type'] == "add")
                {
                    $username = $_POST['username'];
                    $pswmd5 = md5($_POST['password']);
                    if(isset($_POST['prof']) && $_POST['prof']!= "")
                    {
                        $data = explode(",", $_POST['prof']);
                        $idprof = $data[0];
                        if (isset($_POST['admin']))
                        {
                            if($dbhandler->register($username, $pswmd5, 1, $idprof)) echo "Register succesfull";
                        }
                        else
                        {
                            if($dbhandler->register($username, $pswmd5, null, $idprof)) echo "Register succesfull";
                        }
                    }
                    elseif(isset($_POST['admin']))
                    {
                        if($dbhandler->register($username, $pswmd5, 1, null)) echo "Register succesfull";
                    }
                    elseif($dbhandler->register($username, $pswmd5, null, null)) echo "Register succesfull";
                }
    
            
            ?>
            
    </body>
</html>