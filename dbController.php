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
 

function register($name, $surname, $user, $email, $pwd){
     try{
          // prepare a query and execute it
          $query = "INSERT INTO REGISTER (name, surname, username, email, pasw) VALUES (:name, :surname, :user, :email, :password)";
          //echo $query; //for debug
          $sql = $this->conn->prepare($query);
          $sql->execute(array(':name'=>$name, ':surname'=>$surname, ':user'=>$user, ':email'=>$email, ':password'=>$pwd));
          return true;
     }
     catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
     }
}




function login_control($username, $pasw){
  try{
    $query = "SELECT * FROM accounts WHERE username='$username' AND password='$pasw'";
    $result = $this->runQuery($query);
    $res = $result->fetch();
    $id = $res['id'];
    if(is_numeric[$id])
    {
        return $res['username'];
    }
      
 }
  catch(PDOException $e){
    echo 'Error: '.$e->getMessage();
    return false;
  }
}

}

 ?>
