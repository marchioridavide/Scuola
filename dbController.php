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
            echo 'Error: '.$e->getMessage();
            return false;
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
    $query = "SELECT * FROM accounts WHERE username='$username' AND password='".md5($passw)."'";
    $result = $this->runQuery($query);
    $res = $result->fetch();
    $id = $res['id'];
    if(is_numeric[$id])
    {
        return $id;
    }

 }
  catch(PDOException $e){
    echo 'Error: '.$e->getMessage();
    return false;
  }
}
function setPresente($id)
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

    if(!in_array($id, $present) && date($time < "20:15:59"))
    {
        $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

        $sql = $this->conn->prepare($query);
        $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));
        return true;
    }
    elseif(!in_array($id, $present) && date($time < "20:30:59"))
    {
        $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

        $sql = $this->conn->prepare($query);
        $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

        $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
        $sql = $this->conn->prepare($query);
        $sql->execute(array(':idev'=>4, ':id'=>$id, ':giorno'=>date("Y-m-d")));
    }
    elseif(!in_array($id, $present) && date($time < "21:30:59"))
    {
        $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

        $sql = $this->conn->prepare($query);
        $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

        $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
        $sql = $this->conn->prepare($query);
        $sql->execute(array(':idev'=>2, ':id'=>$id, ':giorno'=>date("Y-m-d")));
    }
    elseif(!in_array($id, $present) && date($time < "22:30:59"))
    {
        $query = "insert into presenze (giorno, id_studente) values (:giorno, :id)";

        $sql = $this->conn->prepare($query);
        $sql->execute(array(':giorno'=>date("Y-m-d"), ':id'=>$id));

        $query = "insert into stev (id_evento, id_studente, giorno) values (:idev, :id, :giorno)";
        $sql = $this->conn->prepare($query);
        $sql->execute(array(':idev'=>3, ':id'=>$id, ':giorno'=>date("Y-m-d")));
    }
}
}

 ?>
