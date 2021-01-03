<?php
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
$infoDBNonFiltre = substr($infoDBNonFiltre,0,strlen($infoDBNonFiltre)-1);
var_dump($infoDBNonFiltre);
//Récupération du type de base de donnée
$nameDB = substr($infoDBNonFiltre,0,strpos($infoDBNonFiltre,":"));

//Execution de différents filtreurs pour pouvoir avoir les  autres informations nécessaires

if (strtoupper($nameDB)=="SQLITE") {
    $donnee = filtreSQLite($infoDBNonFiltre);
} else if (strtoupper($nameDB)=="POSTGRESQL") {
    $donnee = filtrePostgreSQL($infoDBNonFiltre);
} else if (strtoupper($nameDB)=="MYSQL") {
    $donnee = filtreMySql($infoDBNonFiltre);
}


function filtreSQLite($infoDBNonFiltre){

}

function filtrePostgreSQL($infoDBNonFiltre){

}
// echo $infoDBNonFiltre;
function filtreMySql($infoDBNonFiltre){
    
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
$dsn=$donnee["namedb"].":"."host=".$donnee["host"].$donnee["port"].";dbname=".$donnee["dbname"];

$conn = new PDO($dsn,$donnee["id"],$donnee["password"]);


