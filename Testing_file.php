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
    filtreSQLite();
} else if (strtoupper($nameDB)=="POSTGRESQL") {
    filtrePostgreSQL();
} else if (strtoupper($nameDB)=="MYSQL") {
    filtreMySql();
}


function filtreSQLite(){

}

function filtrePostgreSQL(){

}

function filtreMySql(){
    //Récupération de l'identifiant
    //Récupération du mot de passe
    //Récupération de l'host
    //Récupération de la dbname
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
