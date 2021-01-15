<?php

require_once __DIR__ . ('/ConnectionBdClass.php');
require_once __DIR__ . ('/../DataBinder/RaceData.php');

use App\Service\ConnectionBdClass;
use App\DataBinder\RaceData;

// Initialisation de tout les les variables nécessaires dans la bse de données

$raceData = new RaceData();
//Ajout de toutes les races qui sont nécessaires dans une liste
$listRace = [];

array_push($listRace,"Humain");
array_push($listRace,"Elfe");
array_push($listRace,"Nain");


//ListRace remplit

foreach ($listRace as $nom ) {
    $raceData->addRace($nom);
}
var_dump($raceData->getListRace());
//Ajout dans la base de données des différents races
$raceData->pushListRace();


$em = new ConnectionBdClass();
$conn = $em->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$stmt= $conn->prepare("INSERT INTO `user`(`email`, `roles`, `password`) VALUES ('user@user.user','','user')");
$stmt ->execute();


