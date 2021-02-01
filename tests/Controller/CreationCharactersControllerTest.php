<?php

use App\Service\ConnectionBdClass;
use App\Controller\CreationCharactersController;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;


class CreationCharactersControllerTest extends TestCase{

    public function creation_value_random(){
        $faker = Faker\Factory::create();
        $FirstNameLastName=$faker->name();
        $lastname = $_POST["lastname"] = explode(" ",$FirstNameLastName)[1];
        $firstname = $_POST["firstname"] = explode(" ",$FirstNameLastName)[0];
        $description = $_POST["Description"] = $faker->text(50);
        $age = $_POST["age"] = rand(15,300);

        return ["age"=>$age,"description"=>$description,"firstname"=>$firstname,"lastname"=>$lastname];
    }

    public function recup_user(){
        $classConn = new ConnectionBdClass();
        $conn = $classConn->getConnection();



        // $conn = new PDO("mysql:host=localhost:3306;dbname=dndinit","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Récupération de l'id d'un des user
        $stmt= $conn->prepare("SELECT id FROM user");
        $stmt ->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'User');

        $fetch = $stmt->fetchAll();
        
        if (!$fetch) {
            $userId =NULL;
        } else {
            $userId = $_POST["userId"]=($fetch[rand(0,count($fetch)-1)]["id"]);
        }
        return $userId;
    }


public function recup_race(){
    $classConn = new ConnectionBdClass();
    $conn = $classConn->getConnection();



    // $conn = new PDO("mysql:host=localhost:3306;dbname=dndinit","root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Récupération de l'id d'une des races
    $stmt= $conn->prepare("SELECT id FROM race");
    $stmt ->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS,'Race');

    $fetch = $stmt->fetchAll();
        
    if (!$fetch) {
        $raceId =NULL;
    } else {
        $raceId = $_POST["raceId"]=($fetch[rand(0,count($fetch)-1)]["id"]);
    }
    return $raceId;
    
}

    /**
     * @test
     */
    public function verification_characters_bien_creer ( ) {

        //Test de la function index du controller
        //Initialisation des valeurs que l'on veut
        // $faker = Faker\Factory::create();
        // $FirstNameLastName=$faker->name();
        // $lastname = $_POST["lastname"] = explode(" ",$FirstNameLastName)[1];
        // $firstname = $_POST["firstname"] = explode(" ",$FirstNameLastName)[0];
        // $description = $_POST["Description"] = $faker->text(50);
        // $age = $_POST["age"] = rand(15,300);

        $listValue = $this->creation_value_random();

        $age = $listValue["age"];
        $description = $listValue["description"];
        $firstname = $listValue["firstname"];
        $lastname = $listValue["lastname"];

        $userId = $this->recup_user();
        $raceId = $this->recup_race();

        $classConn = new ConnectionBdClass();
        $conn = $classConn->getConnection();

        $controller = new CreationCharactersController();
        $infoCreation = $controller->creationPersonnage();

        //Alors on vérifie que les données qui sont enregistré sont les bonnes
       
        $stmt =$conn->prepare("SELECT * FROM characters WHERE lastname LIKE '$lastname' AND firstname LIKE '$firstname' AND age LIKE '$age' AND user_id LIKE '$userId' AND race_id LIKE '$raceId'");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS,"Characters",[]);
        $fetch = $stmt->fetchAll()[0];
        var_dump($fetch);
        assertEquals($lastname,$fetch["lastname"]);
        assertEquals($firstname,$fetch["firstname"]);
        assertEquals($age,$fetch["age"]);
        assertEquals($description,$fetch["description"]);
        //Vérification que l'utilisateur a bien le personnage
        assertEquals($userId,$fetch["user_id"]);
        assertEquals($raceId,$fetch["race_id"]);

        // // $conn = new PDO("mysql:host=localhost:3306;dbname=dndinit","root","");
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // //Récupération de l'id d'un des user
        // $stmt= $conn->prepare("SELECT id FROM user");
        // $stmt ->execute();
        // $stmt->setFetchMode(PDO::FETCH_CLASS,'User');

        // $fetch = $stmt->fetchAll();
        
        // if (!$fetch) {
        //     $userId =NULL;
        // } else {
        //     $userId = $_POST["userId"]=($fetch[rand(0,count($fetch)-1)]["id"]);
        // }

        //Récupération de l'id d'une des race dans la base de données
        
        // dd($raceid,$userId);
        
        
        

        
        
        
        
    }
}