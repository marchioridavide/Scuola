<html>
    <head>
        <link rel =stylesheet href="style.css">
    </head>
<?php

class studente
{
    public  $idstudenti;
    public $Nome;
    public $Cognome;
    public $DataDiNascita;
    public $idClasse;
    public $data;
    public $tempo;


    function __construct($id, $name, $surname, $birth, $classe, $date, $time)
    {
        $this-> idstudenti = $id;
        $this-> Nome = $name;
        $this-> Cognome = $surname;
        $this-> DataDiNascita = $birth;
        $this-> idClasse = $classe;
        $this-> data = $date;
        $this-> tempo = $time;
    }

    
    function printStudentData()
    {
        require_once('dbController.php');
        $dbhandler = new dbcontroller();
        
          if (date($this->tempo < "20:30:59"))
          {
              $presenza = "presente";
              $dbhandler->setPresente($this->idstudenti);
          }
        
        echo "<tr class = '$presenza'>";
        echo " <td>".$this->idstudenti."</td><td>" .$this->Nome. "</td><td>" .$this->Cognome. "</td> <td>" .$this->DataDiNascita. "</td> <td>" .$this->data. "</td><td>" .$this->tempo."</td>";
        echo "</tr>";
    }
    
    function getID()
    {
        return $this->idstudenti;
    }
}


?>
</html>