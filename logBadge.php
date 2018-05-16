<?php 
    session_start();
    require_once("dbController.php");
    require_once("studente.php");
    $badgeid = $_GET["badgeId"];
    $dbhandle = new dbcontroller();
    

    $query = "SELECT * FROM studenti WHERE idstudenti = '$badgeid' " ;
    $result = $dbhandle->runquery($query);
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<table>
  <tr>
    <th>id studente</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Birth date</th>
    <th>date</th>
    <th>Time</th>
  </tr>
  
<?php
    session_start();    
    if(!isset($_SESSION['user_logged'])) header("Location: login.php");
    echo "<h1>".$_SESSION['user_logged']."</h1>";
    
    if(!isset($_SESSION['logged_users'])) $_SESSION['logged_users'] = array();
    $row = $result->fetch();
    date_default_timezone_set("Europe/Rome");
    $student = new studente($row[0], $row[1], $row[2], $row[3], $row[4], date("Y-m-d"), date("H:i:sa") );
 
    if (contains($_SESSION['logged_users'], $_GET['badgeId']) == false & isset($_GET['badgeId']))array_push($_SESSION['logged_users'], serialize($student));

    foreach($_SESSION['logged_users']  as $studente)
    {
        $temp = unserialize($studente);
        $temp -> printStudentData();
    }
    echo "</table>";
    echo "Studenti rimanenti";
    
    $result = $dbhandle->runquery("select * from studenti");
    
    echo "<table>";
    
    while($row = $result->fetch())
    {
        if (contains($_SESSION['logged_users'], $row[0]) == false)
        {
            echo "<tr>";
                echo "<td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td>";
            echo "</tr>";
        }
    }
    
    echo "</table>";

    
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
