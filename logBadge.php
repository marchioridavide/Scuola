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
    <th>Date</th>
    <th>Time</th>
  </tr>
  
<?php
  $row = $result->fetch();
  date_default_timezone_set("Europe/Rome");
  $student = new studente($row[0], $row[1], $row[2], $row[3], $row[4], date("Y-m-d"), date("h:i:sa") );
  if (!isset($_SESSION['logged_users']))
  {
      $_SESSION['logged_users'] = array(serialize($student));
  }
  else
  {
    array_push($_SESSION['logged_users'], serialize($student));
  }

  foreach($_SESSION['logged_users']  as $studente)
  {
    $temp = unserialize($studente);
    $temp -> printStudentData();
  }

?>
</table>

</body>
</html>
