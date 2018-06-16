<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel = "stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
                session_start();
                  //if(!isset($_SERVER['https'])) header("Location: https://127.0.0.1/Scuola/add_account.php");
                  if($_SESSION['admin'] == true)
                  {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="add_account.php">Aggiungi utente<span class="sr-only">(current)</span></a>
                    </li>';
                      
                    echo '<li class="nav-item active">
                    <a class="nav-link" href="entrate_posticipate.php">Entrate posticipate<span class="sr-only">(current)</span></a>
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
            require_once("dbController.php");
            if(!isset($_SESSION['user_logged']) || $_SESSION['admin']!=true) header("Location: login.php");
            $dbhandler = new dbcontroller();
        
            if(isset($_POST['type']) && $_POST['type'] == 'add')
            {
                $dbhandler->addEntrata($_POST['classi'], $_POST['date'], $_POST['ora']);
            }
        ?>
        
        
        <div class = "addAc-form">
        <form action = '' method = 'post'>
            
            <?php
                $datetime = new DateTime('tomorrow');
                $date = $datetime->format('Y-m-d');
                echo "<div class = 'form-group'>
                <input type = 'date' name = 'date' value = '$date' class = 'form-control'>
                </div>"
            ?>
            
            
            <div class = "form-group">
                <input type = "hidden" name = "type" value = "add" >
            </div>
            
            <div class="form-group">
                <?php
                    $query = "select * from classi";
                    $res = $dbhandler->runQuery($query);
                    echo "<select name = 'classi' class='form-control'>";
                    while($row = $res->fetch())
                    {
                        echo "<option>".$row['Nome']."</option>";
                    }

                    echo "</select>";

                ?>
            </div>
            
            <div class="form-group">
                Entra in: 
                <select class = 'form-control' name ='ora'>
                    <option>2 ora</option>
                    <option>3 ora</option>
                    <option>Non entra</option>
                </select>
            </div>
            
            <div class="form-group">
                <input type = "submit" class = 'btn btn-primary' value = 'Invia'>
            </div>
            
        </form>
        </div>
        
    </body>
</html>