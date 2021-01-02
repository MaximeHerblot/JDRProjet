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

//Récupération du type de base de donnée
$nameDB = substr($infoDBNonFiltre,0,strpos($infoDBNonFiltre,":"));

//Execution de différents filtreurs pour pouvoir avoir les  autres informations nécessaires

if (strtoupper($nameDB)=="SQLITE") {
    filtreSQLite($infoDBNonFiltre);
} else if (strtoupper($nameDB)=="POSTGRESQL") {
    filtrePostgreSQL($infoDBNonFiltre);
} else if (strtoupper($nameDB)=="MYSQL") {
    filtreMySql($infoDBNonFiltre);
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
}





//Récupération des données pour pouvoir récupérer les infos pour la bases de données


// //Ouverture du fichier
// $file = fopen(".env", "r+");
// $filestr = fread($file,filesize(".env"));

// //Récupération des données pour pouvoir récupérer les infos pour la bases de données
// $debut="DATABASE_URL=";
// $fin = "#";
// $pos = strpos($filestr,$debut)+strlen($debut);
// $posfin = strpos($filestr,"#",$pos);

// $length = strlen("DATABASE_URL");

// echo substr($filestr,$pos+$length+1,$posfin-$pos-$length-1);

// echo substr($filestr,$pos+$length+1,$posfin-$pos-$length-1);
