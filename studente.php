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
        echo "<tr>";
        echo " <td>" .$this->Nome. "</td><td>" .$this->Cognome. "</td> <td>" .$this->DataDiNascita. "</td> <td>" .$this->data. "</td><td>" .$this->tempo."</td>";
        echo "</tr>";
    }
}


?>