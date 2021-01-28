<?php

require_once __DIR__ . ('/ConnectionBdClass.php');
require_once __DIR__ . ('/../DataBinder/RaceData.php');
require_once __DIR__ . ('/../DataBinder/CharactersClassData.php');

use App\Service\ConnectionBdClass;
use App\DataBinder\RaceData;
use App\DataBinder\CharactersClassData;
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
//Ajout dans la base de données des différents races
$raceData->pushListRace();


$ClassData = new CharactersClassData();
//Ajout de toutes les races qui sont nécessaires dans une liste
$listClass = [];

array_push($listClass,"Barbare");
array_push($listClass,"Barde");
array_push($listClass,"Clerc");
array_push($listClass,"Druide");
array_push($listClass,"Ensorceleur");
array_push($listClass,"Guerrier");
array_push($listClass,"Magicien");
array_push($listClass,"Moine");
array_push($listClass,"Paladin");
array_push($listClass,"Rôdeur");
array_push($listClass,"Roublard");
array_push($listClass,"Sorcier");


// exit();





//ListRace remplit

foreach ($listClass as $class ) {
    $ClassData->addClass($class);
}
//Ajout dans la base de données des différents races
$ClassData->pushListClass();


$em = new ConnectionBdClass();
$conn = $em->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$stmt= $conn->prepare("INSERT INTO `user`(`email`, `roles`, `password`) VALUES ('user@user.user','','user')");
$stmt ->execute();


