<?php
  Class dbcontroller{

  private $servername="localhost";
  private $username="root";
  private $password="mysql";
  private $dbname="scuola";
  private $conn;

  function __construct(){
    $this-> connectDB();
  }
  function connectDB() {
//      $dbcreds = fopen("../../db/db.txt", "r") or die("Unable to open file!");
//      $username = fgets($dbcreds);
//      $password = fgets($dbcreds);
//      fclose($dbcreds);
	  try
	  {
	    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
	    // set the PDO error mode to exception
	    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  //  echo "Connected successfully";
	  }
	  catch(PDOException $e)
	  {
	    echo "Connection failed: " . $e->getMessage();
	  }
	}

function runQuery($query){
    $sth = $this->conn->prepare($query);
    $sth -> execute();
    return $sth;
}

function runRow($query){
  $sth = $this->conn->prepare($query);
  $sth ->execute();
  return $sth -> fetchcolumn(); //ritorn n righe
}

function numRows($query) {
  $sth = $this->conn->prepare($query);
  $sth->execute();
  return $sth->rowCount();
}


function register($user, $pwd, $admin, $idprof){
     try{
          // prepare a query and execute it
          $query = "INSERT INTO accounts (username, password, admin, idprof) VALUES (:username, :password, :admin, :idprof)";
          //echo $query; //for debug
          $sql = $this->conn->prepare($query);
          $sql->execute(array(':username'=>$user, ':password'=>$pwd, ':admin'=>$admin, ':idprof'=>$idprof));
          return true;
     }
     catch(PDOException $e){
            echo "<script language = 'javascript'>
            alert('Lo username utilizzato è già presente nel database');
            </script>";
     }
}


function isadmin($id)
{
    try{
        $query = "SELECT * FROM accounts WHERE id = $id and admin = 1";
        if($this->runRow($query) >= 1) return true;
    }
    catch(PDOException $e){
        echo 'Error: '.$e->getMessage();
        return false;
    }
}

function login_control($username, $pasw){
  try{
      $md5pasw = md5($pasw);
    $query = "SELECT * FROM accounts WHERE username='$username' AND password='$md5pasw'";
    $result = $this->runQuery($query);
    $res = $result->fetch();
    $id = $res['id'];
    if(is_numeric($id))
    {
        return $id;
    }

 }
  catch(PDOException $e){
    echo 'Error: '.$e->getMessage();
    return false;
  }
}
      
function UpdateGiustifica($idstudente, $idevento)
{
    try
    {
        $query="UPDATE stev SET giustificato = '1' WHERE id_studente='$idstudente' AND id='$idevento'";
        $result = $this->runQuery($query);
        $current = $_SERVER['REQUEST_URI']; 
        return true;
    }
    catch(PDOException $e)
    {
        echo 'Error ' . $e->getMessage();
        return false;
    }
}
      
function setPresente($id)
{
    try
    {
    date_default_timezone_set("Europe/Rome");
    $q = "select id_studente from presenze where giorno='".date("Y-m-d")."'";
    $res = $this->runQuery($q);
    $present = array();
    while($row = $res->fetch())
    {
        array_push($present, $row['id_studente']);
    }

    $time = date("H:i:s");
    $date = date("Y-m-d");
    
    $permissions = $this->runQuery("select idClasse from studenti where idstudenti = $id and studenti.idClasse in (select idclasse from entrate_posticipate where giorno = '$date')"); //check if student has permission of posticipated entrance
    $res = $permissions->fetch();
    if(isset($res[0]))
    {
        $hour = $this->runQuery("select in_ora from entrate_posticipate where idclasse = '$res[0]'");
        $hour = $hour->fetch();
        if($hour[0] == 2)
        {
             if(!in_array($id, $present) && (strtotime($time) < strtotime("9:15:59")))
                {
                 echo "memes";
                    $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));
                    return true;
                }
                elseif(!in_array($id, $present) && (strtotime($time) < strtotime("9:30:59")))
                {
                    $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

                    $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':idev'=>4, ':id'=>$id, ':giorno'=>date("Y-m-d")));
                }
                elseif(!in_array($id, $present) && (strtotime($time) < strtotime("10:30:59")))
                {
                    $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

                    $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':idev'=>2, ':id'=>$id, ':giorno'=>date("Y-m-d")));
                }
        }
        elseif($hour[0] == 3)
        {
            if(!in_array($id, $present) && (strtotime($time) < strtotime("10:14:59")))
                {
                    $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));
                    return true;
                }
                elseif(!in_array($id, $present) && (strtotime($time) < strtotime("10:30:59")))
                {
                    $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

                    $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
                    $sql = $this->conn->prepare($query);
                    $sql->execute(array(':idev'=>4, ':id'=>$id, ':giorno'=>date("Y-m-d")));
                }
        }
    }
    else
    {
        if(!in_array($id, $present) && (strtotime($time) < strtotime("8:14:59")))
        {
            $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

            $sql = $this->conn->prepare($query);
            $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));
            return true;
        }
        elseif(!in_array($id, $present) && (strtotime($time) < strtotime("8:30:59")))
        {
            $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

            $sql = $this->conn->prepare($query);
            $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

            $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
            $sql = $this->conn->prepare($query);
            $sql->execute(array(':idev'=>4, ':id'=>$id, ':giorno'=>date("Y-m-d")));
        }
        elseif(!in_array($id, $present) && (strtotime($time) < strtotime("9:30:59")))
        {
            $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

            $sql = $this->conn->prepare($query);
            $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

            $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
            $sql = $this->conn->prepare($query);
            $sql->execute(array(':idev'=>2, ':id'=>$id, ':giorno'=>date("Y-m-d")));
        }
        elseif(!in_array($id, $present) && (strtotime($time) < strtotime("10:30:59")))
        {
            $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

            $sql = $this->conn->prepare($query);
            $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

            $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
            $sql = $this->conn->prepare($query);
            $sql->execute(array(':idev'=>3, ':id'=>$id, ':giorno'=>date("Y-m-d")));
        }
    }
    }catch (Exception $e)
    {
        echo "badge non valido";
    }
}
function checkAssenza()
{
    date_default_timezone_set("Europe/Rome");
    $current = date("H:i:s");
    $day = date("Y-m-d");
    
    if(strtotime($current) > strtotime("10:30:59"))
    {
        $query = "select * from studenti where idstudenti not in (select id_studente from presenze where giorno = '$day')";
        $result = $this->runQuery($query);
        while ($row = $result->fetch())
        {
            $id = $row['idstudenti'];
            $this->setAssente($id, $day);
        }
    }
}
function setAssente($id, $day)
{
    $assenti = array();
    $query = "select * from stev where giorno ='$day'";
    $result = $this->runQuery($query);
    while ($row = $result->fetch())
    {
        array_push($assenti, $row['id_studente']);
    }
    $query = "select * from studenti, classi, entrate_posticipate where studenti.idstudenti = '$id' and studenti.idClasse = classi.idClassi and classi.idClassi = entrate_posticipate.idclasse and entrate_posticipate.giorno = '$day' and entrate_posticipate.in_ora = '0'";
    $result = $this->numRows($query);
    if(!in_array($id, $assenti) && $result == 0)
    {
        $query = "insert into stev (id_evento, id_studente, giorno, giustificato, visualizza) values (1, $id,'$day', 0, 0)";
        $this->runQuery($query);
    }
}
function addEntrata($classe, $giorno, $ora)
{
    $code = $ora;
    switch($ora)
    {
        case "2 ora":
            $code = 2;
            break;
        case "3 ora":
            $code = 3;
            break;
        case "Non entra":
            $code = 0;
            break;
    }
    $query = "select idClassi from classi where classi.Nome = '$classe'";
    $result = $this->runQuery($query);
    $row = $result->fetch();
    $class = $row[0];
    $query = "insert into entrate_posticipate (giorno, idclasse, in_ora) values ('$giorno', '$class', '$code')";
    $this->runQuery($query);
    echo "<script language = 'javascript'>
        alert('Eccezione aggiunta correttamente');
    </script>";
}
      
function UpdateGiustificaVisual($idstudente, $idevento)
{
    try
    {
        $query="UPDATE stev SET visualizza = '1' WHERE id_studente='$idstudente' AND id='$idevento'";
        $result = $this->runQuery($query);
        $current = $_SERVER['REQUEST_URI']; 
        return true;
    }
    catch(PDOException $e)
    {
        echo 'Error ' . $e->getMessage();
        return false;
    }
}
    

}

 ?>
