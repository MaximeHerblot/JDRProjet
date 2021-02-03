<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\Race;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationCharactersController extends AbstractController
{

    /**
     * @Route("/creation/characters", name="creation_characters")
     */
    public function index(): Response
    {



        $em = $this->getDoctrine()->getManager();
        //Récupération des personnages de l'utilisateur
        
        $RepoRace = $em->getRepository(Race::class)->findAll();

        // dd($RepoRace);

    
        return $this->render('creation_characters/index.html', [
            'controller_name' => 'CreationCharactersController',
            'RepoRace' => $RepoRace,
        ]);
    }

    /**
     * @Route ("/creation/characters/requete",name ="requete_creation_characters")
     */

    public function creationPersonnage(){
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $age = $_POST["age"];
        $description = $_POST["Description"];
        if (isset($_POST["userId"])){
            $userId = $_POST["userId"];
        }
        
        if (isset($_POST["raceId"])){
            $raceid = $_POST["raceId"];
        } 
        $classId = $_POST["classId"];
        //Insert d'un personnage dans la base
        // var_dump($className);
        
        // $id = $this->getUser()->getId();
        $conn = new PDO("mysql:host=localhost;dbname=dndinit2","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO characters (lastname, firstname, age, description,user_id,race_id)
        VALUES ('$lastname','$firstname','$age','$description','$userId','$raceid' )";
        var_dump($sql);
        $conn->exec($sql);
        
        $conn = new PDO("mysql:host=localhost;dbname=dndinit2","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id FROM characters WHERE lastname LIKE '".$lastname."' AND firstname LIKE '".$firstname."'" ;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_COLUMN ,0);
        $fetch = $stmt->fetchAll();
        $charactersId = ($fetch[count($fetch)-1]);
        

        //Ajout de la classe dans le personnage

        $sql = "INSERT INTO characters_character_class (characters_id ,character_class_id , level) VALUES ($charactersId, $classId , 1)";
        
        // var_dump($sql);
        
        $conn->exec($sql);
        
        $rep = array("lastname"=>$lastname,"firstname"=>$firstname,"age"=>$age,"description"=>$description,"userId"=>$userId,"charactersId"=>$charactersId);
        
        return new Response ("",200,$rep);
    }
}
