<?php

namespace App\Service;
use PDO;

class ConnectionBdClass{

    private $connection;
    private $envFile;

    public function __construct()
    {
        
    }


    public function getConnection(){
        //Trouver l'information
        $infoDBNonFiltre = $this->getInformation();
        //Trouvé le type de base de données
        $dbType = $this->getDbType($infoDBNonFiltre);
        //Formatage de l'information
        $donnee= $this->formatageInformation($infoDBNonFiltre,$dbType);

        $dsn=$donnee["namedb"].":"."host=".$donnee["host"].$donnee["port"].";dbname=".$donnee["dbname"];
        return new PDO($dsn,$donnee["id"],$donnee["password"]);
        //Ouverture de la connection
        
    }

    public function setEnvFile(string $locationEnvFile){
        $this->envFile = file($locationEnvFile);
    }

    public function getInformation(){
        //Ouverture du fichier
        $file2 = (file(".env"));
        //Donnée que l'on cherche
        $debut="DATABASE_URL=";

        $length = strlen("DATABASE_URL=");

        //Récupération de la ligne 
        $i=0;
        foreach ($file2 as $lineFile){
            
            if (substr($lineFile,0,$length)==$debut) {
                
                $indiceLine = $i;
                
            }
            $i++;
        }
        //Récupération des données dans le .env de la database

        $infoDBNonFiltre = substr($file2[$indiceLine],$length);
        return substr($infoDBNonFiltre,0,strlen($infoDBNonFiltre)-1);
    }

    public function getDbType($infoDBNonFiltre){
        return substr($infoDBNonFiltre,0,strpos($infoDBNonFiltre,":"));
    }

    public function formatageInformation($infoDBNonFiltre,$dbType){
        if (strtoupper($dbType)=="SQLITE") {
            return $this->filtreSQLite($infoDBNonFiltre);
        } else if (strtoupper($dbType)=="POSTGRESQL") {
            return $this->filtrePostgreSQL($infoDBNonFiltre);
        } else if (strtoupper($dbType)=="MYSQL") {
            return $this->filtreMySql($infoDBNonFiltre);
        }
    }

    public function filtreSQLite($infoDBNonFiltre){

    }
    
    public function filtrePostgreSQL($infoDBNonFiltre){
    
    }

    public function filtreMySql($infoDBNonFiltre){
        
        //Récupération de l'identifiant
        //Récupération du mot de passe
        $log = substr($infoDBNonFiltre,8,strpos($infoDBNonFiltre,"@")-8);
        $identifiant = substr($log,0,strpos($log,":"));
        $password = substr($log,strpos($log,":")+1);
        
        //Récupération de l'host
        $hostPortName= substr($infoDBNonFiltre,strpos($infoDBNonFiltre,"@")+1);
        $host = substr($hostPortName,0,strpos($hostPortName,":"));
        //Récupération de la dbname
        $dbname = substr($hostPortName,strpos($hostPortName,"/")+1);
        $dbname = substr($dbname,0,strlen($dbname)-1);
        $port = substr($hostPortName,strpos($hostPortName,":"),5);
        return ["namedb"=>"mysql","id"=>$identifiant,"password"=>$password,"host"=>$host,"dbname"=>$dbname,"port"=>$port];
    }
}







