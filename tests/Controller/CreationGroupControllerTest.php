<?php

use App\Controller\CreationGroupController;
use App\Service\ConnectionBdClass;
use PHPUnit\Framework\TestCase;

class CreationGroupControllerTest extends TestCase{

    public function conn(){
        $classConn = new ConnectionBdClass();
        $conn = $classConn->getConnection();



        // $conn = new PDO("mysql:host=localhost:3306;dbname=dndinit","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function recup_random_user_id(){
        $conn = $this->conn();

        $sql = "SELECT id FROM User";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        
        //Sélection de l'utilisateur de maniere aléatoire

        return $fetch[count($fetch)-1]["id"];
        
    }

    public function recup_random_characters(){
        $conn = $this->conn();
        $sql = "SELECT id FROM Characters";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        $ind  = random_int(0,count($fetch)-1);
        $idCharacter = array_splice($fetch,$ind,1);
        
        $ind  = random_int(0,count($fetch)-1);
        $idCharacter2 = array_splice($fetch,$ind,1);
        return [$idCharacter[0]["id"],$idCharacter2[0]["id"]];
    }
    /**
     * @test
     */
    public function group_bien_creer(){
        $faker = Faker\Factory::create();
        $nameGroup = $faker->name();
        
        $userId = $_POST["userId"] = $this->recup_random_user_id();
        // var_dump($userId);
        $listIdCharacters = $_POST["listIdCharacters"] =$this->recup_random_characters();

        $controller = new CreationGroupController();
        $controller -> creationGroup();

        //Vérification que le groupe a bien été créer
        $conn = $this->conn();

        $sql = "SELECT groupe_id FROM characters"

    }



}