
<?php 
    session_start();
    //if(!isset($_SERVER['https'])) header("Location: https://127.0.0.1/Scuola/logBadge.php");
    require_once("dbController.php");
    require_once("studente.php");
    $badgeid = $_GET["badgeId"];
    $dbhandle = new dbcontroller();

    $dbhandle->checkAssenza();
    
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel = "stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</head>
<body>
    
<div id = "bigmodal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <center>
            <div class = "scroll">
            </div>
        </center>
    </div>
  </div>
</div>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
                if($_SESSION['admin'] == true)
                {
                  echo '<li class="nav-item">
                  <a class="nav-link" href="add_account.php">Aggiungi utente<span class="sr-only">(current)</span></a>
                    </li>';
                    echo '<li class="nav-item ">
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
            <li class="nav-item active">
                <a class="nav-link" href="logBadge.php">Log badge</a>
            </li>
        </ul>
    </div>
</nav>

<table class='table table-striped'>
<thead class='thead-dark'>
<tr>
    <th>id studente</th>
    <th>Nome</th>
    <th>Cognome</th>
    <th>Data di nascita</th>
    <th>Eventi</th>
  </tr>
    <thead>
  
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(!isset($_SESSION['user_logged'])) header("Location: login.php");
    
    echo "<br><form action = '' method = 'get'>";
        
        $classe = $_GET['classi'];
        $query = "select * from classi";
        $res = $dbhandle->runQuery($query);
        echo "<select name = 'classi' class='form-control' selected=$classe><option>Tutte le classi</option>";
        while($row = $res->fetch())
        {
            $classe = $row['Nome'];
            echo "<option>$classe</option>";
        }
        echo "</select><br>";
        echo "<button type = 'submit' class='btn btn-primary'>Applica</button><br><br>";
        
    echo "</form>";
        
    date_default_timezone_set("Europe/Rome");
    if(isset($_GET['badgeId']))$dbhandle->setPresente($badgeid);
//    if(!isset($_SESSION['logged_users'])) $_SESSION['logged_users'] = array();
//    $row = $result->fetch();
//    date_default_timezone_set("Europe/Rome");
//    $student = new studente($row[0], $row[1], $row[2], $row[3], $row[4], date("Y-m-d"), date("H:i:s") );
// 
//    if (contains($_SESSION['logged_users'], $_GET['badgeId']) == false & isset($_GET['badgeId']))
//    array_push($_SESSION['logged_users'], serialize($student));
//
//    foreach($_SESSION['logged_users']  as $studente)
//    {
//        $temp = unserialize($studente);
//        $temp -> printStudentData();
//    }
    if(!isset($_GET['classi']) || $_GET['classi'] == "Tutte le classi")   //check if is set a class filter
    {
        $result = $dbhandle->runQuery("select * from studenti where idstudenti in(select id_studente from presenze where giorno ='".date("Y-m-d")."')");
    }
    else
    {
        $classe = $_GET['classi'];
        $result = $dbhandle->runQuery("select * from studenti, classi where studenti.idClasse = classi.idClassi and classi.Nome = '$classe' and idstudenti in(select id_studente from presenze where giorno ='".date("Y-m-d")."')");
    }
        
    while($row = $result->fetch())           //apply notifications badge
    {
        $id = $row[0];
        $notifications = $dbhandle->numRows("select * from stev where id_studente = $id and giustificato = 0 and visualizza = 0");
        echo "<tr class = 'presente'>";
        if($notifications != 0)
        {
            echo "<td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td>
            <td><center> 
                <form action='eventi.php' method='GET'>
                    <input type='hidden' name='idstudente' value=".$row[0]. " />
                    <input type='hidden' name='nome' value=".$row[1]. " />
                    <input type='hidden' name='cognome' value=".$row[2]. " />
                    <button type='submit' class='notifications'> $notifications </button>
                </form>
            </center></td>";
        }
        else
        {
            echo "<td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>
                <center> 
                <form action='eventi.php' method='GET'>
                    <input type='hidden' name='idstudente' value=".$row[0]. " />
                    <input type='hidden' name='nome' value=".$row[1]. " />
                    <input type='hidden' name='cognome' value=".$row[2]. " />
                    <button type='submit' class='alljustified'> 0 </button>
                </form>
            </center>
            </td>";
        }
        echo "</tr>";
    }
       
    echo "</tbody>
    </table>";
    echo "Studenti assenti";
        
    if(!isset($_GET['classi']) || $_GET['classi'] == "Tutte le classi")
    {
        $result = $dbhandle->runQuery("select * from studenti where idstudenti not in(select id_studente from presenze where giorno ='".date("Y-m-d")."')"); 
    }
    else
    {
        $classe = $_GET['classi'];
        $result = $dbhandle->runQuery("select * from studenti, classi where studenti.idClasse = classi.idClassi and classi.Nome = '$classe' and idstudenti not in(select id_studente from presenze where giorno ='".date("Y-m-d")."')"); 
    }
            
    
    echo "<table class='table table-striped'>
        <thead class='thead-dark'>
            <tr>
            <th scope='col'>Id studente</th>
            <th scope='col'>Nome</th>
            <th scope='col'>Cognome</th>
            <th scope='col'>Data di nascita</th>
            <th scope='col'>Eventi</th>
            </tr>
        </thead>
        
        <tbody>";

    while($row = $result->fetch())
    {
        $id = $row[0];
        $notifications = $dbhandle->numRows("select * from stev where id_studente = $id and giustificato = 0 and visualizza = 0");
        echo "<tr>";
        if($notifications != 0)
        {
            echo "<td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td>
            <td><center> 
                <form action='eventi.php' method='GET'>
                    <input type='hidden' name='idstudente' value=".$row[0]. " />
                    <input type='hidden' name='nome' value=".$row[1]. " />
                    <input type='hidden' name='cognome' value=".$row[2]. " />
                    <button type='submit' class='notifications'> $notifications </button>
                </form>
            </center></td>";
        }
        else
        {
            echo "<td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>
                <center> 
                <form action='eventi.php' method='GET'>
                    <input type='hidden' name='idstudente' value=".$row[0]. " />
                    <input type='hidden' name='nome' value=".$row[1]. " />
                    <input type='hidden' name='cognome' value=".$row[2]. " />
                    <button type='submit' class='alljustified'> 0 </button>
                </form>
            </center>
            </td>";
        }
        echo "</tr>";
    }
    
    echo "</tbody>
        </table>";

    
    function contains($array, $elementid)
    {
        foreach($array as $s)
        {
            if (unserialize($s)->getID() == $elementid) return true;
        }
        return false;
    }
?>
        

    
</table>

</body>
</html>
