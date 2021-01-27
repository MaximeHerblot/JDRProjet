<?php

namespace App\DataBinder;


use App\Service\ConnectionBdClass;
use PDO;

class CharactersClassData {

    private $listCharactersClass ;

    public function __construct()
    {
        $this -> listCharactersClass=[];
        
    }
    
    public function addClass( string $nameClass ){
        //Aucune vérification 
        

        //Vérification dans la liste envoyé
        
        $ClassNonDansListe=1;

        foreach ($this->listCharactersClass as $nomClass) {
            if ($nameClass==$nomClass) {
                $ClassNonDansListe=0;
            }

        }

        //Vérification dans la base de données
        $em = new ConnectionBdClass();
        $conn = $em->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt =$conn->prepare("SELECT name FROM Character_Class");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_COLUMN,0);
        $listFetch = $stmt->fetchAll();

        foreach ($listFetch as $nomClass) {
            if ($nameClass==$nomClass) {
                $ClassNonDansListe=0;
            }
            

        }
        if($ClassNonDansListe){
            array_push($this -> listCharactersClass,$nameClass);
        }
        
    }

    public function getListClass() :array {
        return $this->listClass;
    }

    public function pushListClass(): array{

        $em = new ConnectionBdClass();
        $conn = $em->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        

        $listClass = $this->listCharactersClass;
        
        for ($i=0; $i <count($listClass) ; $i++) { 
            $stmt= $conn->prepare("INSERT INTO `Character_Class` (`name`) VALUES ('$listClass[$i]')");
            $stmt ->execute();
        }
        return $listClass;
    }
}


