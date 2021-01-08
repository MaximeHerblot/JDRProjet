<?php

namespace App\DataBinder;


use App\Service\ConnectionBdClass;
use PDO;

class RaceData {

    private $listRace ;

    public function __construct()
    {
        $this -> listRace=[];
        
    }
    
    public function addRace( string $nameRace ){
        //Aucune vérification 
        

        //Vérification dans la liste envoyé
        
        $RaceNonDansListe=1;

        foreach ($this->listRace as $nomRace) {
            if ($nameRace==$nomRace) {
                $RaceNonDansListe=0;
            }

        }

        //Vérification dans la base de données
        
        $conn = new PDO("mysql:host=localhost;dbname=dndinit","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt =$conn->prepare("SELECT name FROM race");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_COLUMN,0);
        $listFetch = $stmt->fetchAll();
        // dd($listFetch);

        foreach ($listFetch as $nomRace) {
            if ($nameRace==$nomRace) {
                $RaceNonDansListe=0;
            }

        }
        if($RaceNonDansListe){
            array_push($this -> listRace,$nameRace);
        }
        
    }

    public function getListRace() :array {
        return $this->listRace;
    }

    public function pushListRace(): array{

        $em = new ConnectionBdClass();
        $conn = $em->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        

        $listRace = $this->listRace;
        for ($i=0; $i <count($listRace) ; $i++) { 
            $stmt= $conn->prepare("INSERT INTO race VALUES $listRace[$i]");
            $stmt ->execute();
        }
        return $listRace;
    }
}


