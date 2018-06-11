<?php
    $idStudente = $_GET["idstudente"];
    $nome = $_GET["nome"];
    $cognome = $_GET["cognome"];
    require_once("dbController.php");
    require_once("studente.php");
    session_start();
    $dbhandle = new dbcontroller();
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel = "stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</head>
<body>
    
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
                if($_SESSION['admin'] == true)
                {
                  echo '<li class="nav-item">
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
            <li class="nav-item ">
                <a class="nav-link" href="logBadge.php">Log badge</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="">Eventi</a>
            </li>
        </ul>
    </div>
</nav>


<table class='table table-striped'>
    <thead class='thead-dark'>
        <tr>
        <th scope='col'>Id studente</th>
        <th scope='col'>Nome</th>
        <th scope='col'>Cognome</th>
        <th scope='col'>Evento</th>
        <th scope='col'>Giorno</th>
        <th scope='col'></th>
        </tr>
    </thead>
    
    <tbody>

    <?php
       $eventi = $dbhandle->runQuery("select * from stev where id_studente = $idStudente");
        
       while($row = $eventi->fetch())
        {
           echo "<tr>";
            if($row[1]==1)
            {
                echo "<td>" . $row[2] . "</td>
                <td>" . $nome . "</td>
                <td>" . $cognome . "</td>
                <td> Assenza </td>
                <td>" .$row[3] . "</td>
                <td> ";
                if ($row['giustificato'] == 0) 
                {
                    echo "<center> <button type='button' class='btn btn-Dark' data-toggle='modal' data-target='#myModal'>Giustifica</button> </center>";
                }
                elseif($row['giustificato'] == 1){
                    echo "<center>Giustificato</center>";
                }
                echo "</td>"; 
            }
            else if($row[1]==2 || $row[1]==3)
            {
                echo "<td>" . $row[2] . "</td>
                <td>" . $nome . "</td>
                <td>" . $cognome . "</td>
                <td> Ritardo </td>
                <td>" .$row[3] . "</td>
                <td> ";
                if ($row['giustificato'] == 0) 
                {
                    echo "<center> <button type='button' class='btn btn-Dark' data-toggle='modal' data-target='#myModal'>Giustifica</button> </center>";
                }
                elseif($row['giustificato'] == 1){
                    echo "<center>Giustificato</center>";
                }
                echo "</td>";   
            }
            else if($row[1]==4) 
            {
                echo "<td>" . $row[2] . "</td>
                <td>" . $nome . "</td>
                <td>" . $cognome . "</td>
                <td> Assenza </td>
                <td>" .$row[3] . "</td>
                <td> ";
                if ($row['giustificato'] == 0) 
                {
                    echo "<center> <button type='button' class='btn btn-Dark' data-toggle='modal' data-target='#myModal'>Giustifica</button> </center>";
                }
                elseif($row['giustificato'] == 1){
                    echo "<center>Giustificato</center>";
                }
                echo "</td>"; 
            }
           echo "</tr>";

        }

        
        
    echo "</tbody>";
echo "</table>";


   echo "<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
            <form action='giustifica.php' method='POST'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Alert!</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <p>Sei sicuro di voler giustificare?</p>
            </div>
            <div class='modal-footer'>
                <input type='hidden' name='idstudente' value=$idStudente />
                <button type='submit' type='submit' class='btn btn-primary'>Save changes</button>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
            </div>
            </form>
        </div>
    </div>";
?>
</body>
</html>