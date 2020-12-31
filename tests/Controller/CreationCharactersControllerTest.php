<?php

use App\Controller\CreationCharactersController;
use App\Controller\HomePageController;
use App\Entity\Characters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPUnit\Framework\assertEquals;

class CreationCharactersControllerTest extends TestCase{

    /**
     * @test
     */
    public function verification_characters_bien_creer ( ) {

        //Test de la function index du controller
        //Initialisation des valeurs que l'on veut
        $faker = Faker\Factory::create();
        $FirstNameLastName=$faker->name();
        $lastname = $_POST["lastname"] = explode(" ",$FirstNameLastName)[1];
        $firstname = $_POST["firstname"] = explode(" ",$FirstNameLastName)[0];
        $description = $_POST["Description"] = $faker->text(50);
        $age = $_POST["age"] = rand(15,300);

        $conn = new PDO("mysql:host=localhost;dbname=dndinit","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt= $conn->prepare("SELECT id FROM user");
        $stmt ->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'User');

        $fetch = $stmt->fetchAll();
        
        $userId = $_POST["userId"]=($fetch[rand(0,count($fetch)-1)]["id"]);
        $stmt= $conn->prepare("SELECT id FROM race");
        $stmt ->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Race');

        $fetch = $stmt->fetchAll();
        
        $raceId = $_POST["raceId"]=($fetch[rand(0,count($fetch)-1)]["id"]);
        
        // dd($raceid,$userId);
        //Action qui va se passé 
        //Un personnage a un prenom un nom un age une description

        //Création de différentes entité avec faker
        
        $controller = new CreationCharactersController();
        $infoCreation = $controller->creationPersonnage();

        
        
        //Alors on vérifie que les données qui sont enregistré sont les bonnes
       
        $stmt =$conn->prepare("SELECT * FROM characters WHERE lastname LIKE '$lastname' AND firstname LIKE '$firstname' AND age LIKE '$age' AND user_id LIKE '$userId' AND race_id LIKE '$raceId'");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS,"Characters",[]);
        $fetch = $stmt->fetchAll()[0];
        
        assertEquals($lastname,$fetch["lastname"]);
        assertEquals($firstname,$fetch["firstname"]);
        assertEquals($age,$fetch["age"]);
        assertEquals($description,$fetch["description"]);
        //Vérification que l'utilisateur a bien le personnage
        assertEquals($userId,$fetch["user_id"]);
        assertEquals($raceId,$fetch["race_id"]);

        // assertEquals($lastname,$infoCreation->{"lastname"});
        // assertEquals($firstname,$infoCreation->{"firstname"});
        // assertEquals($age,$infoCreation->{"age"});
        // assertEquals($description,$infoCreation->{"description"});
        // //Vérification que l'utilisateur a bien le personnage
        // assertEquals($userId,$infoCreation->{"id"});
    }
}