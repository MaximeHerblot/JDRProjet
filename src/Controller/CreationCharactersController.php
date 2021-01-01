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
        //Insert d'un personnage dans la base
        
        $Characters = new Characters();
        $Characters->setLastname($lastname);
        $Characters->setFirstname($firstname);
        $Characters->setAge($age);
        $Characters->setDescription($description);
        
        // $id = $this->getUser()->getId();
        $conn = new PDO("mysql:host=localhost;dbname=dndinit","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO characters (lastname, firstname, age, description,user_id,race_id)
        VALUES ('$lastname','$firstname','$age','$description','$userId','$raceid')";
        $conn->exec($sql);
        return new Response ("",200,array("lastname"=>$lastname,"firstname"=>$firstname,"age"=>$age,"description"=>$description,"userId"=>$userId));
    }
}
