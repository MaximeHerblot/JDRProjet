<?php

namespace App\Controller;

use App\Entity\Group;
use App\Service\ConnectionBdClass;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationGroupController extends AbstractController
{
    public function recup_personnage_choissable(){
        //Les personnages choissable sont ceux que l'utilisateur a le joueur en tant qu'amis 


    }

    /**
     * @Route("/creation/group", name="creation_group")
     */
    public function index(): Response
    {

        return $this->render('creation_group/index.html.twig', [
            'controller_name' => 'CreationGroupController',
        ]);
    }

    /**
     * @Route ("/creation/group/requete")
     */
    public function creationGroup(){
        $userId = $_POST["userId"];
        $nameGroup = $_POST["nameGroup"];
        $link = $_POST["link"];
        $classConn= new ConnectionBdClass();
        $conn = $classConn->getConnection();
        //Execution de la requete sql
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `group` (`name_group`, `user_id`, `link`) 
        VALUES ('$nameGroup',".$userId.",'$link')";
        // $sth = $conn->prepare($sql);
        $conn->exec($sql);
        
        //Récupération de l'id du groupe qui vient d'être créer
        $sql = "SELECT id FROM `group` WHERE name_group LIKE '".$nameGroup."' AND user_id LIKE ".$userId."";
        // $sql = "SELECT id FROM group WHERE name_group LIKE '".$nameGroup."' AND userId LIKE '".$userId."'"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_COLUMN ,0);
        $fetch = $stmt->fetchAll();
        // var_dump($fetch);
        //Parcours de la liste des characters

        // foreach ($_POST["listIdCharacters"] as $charactersId) {
        //     $sql = "UPDATE `characters` SET `groupe_id` = ".$group_id." WHERE id = ".$charactersId;
        //     $conn->exec($sql);
        // }
        
    }
    /**
     * @Route ("/creation/groupe/ajout/personnage/{link}")
     */
    public function ajout_personnage_dans_le_groupe(string $link){
        
        $sql = "SELECT id FROM `group` WHERE link LIKE '".$link."'";
        $connClass = new ConnectionBdClass();
        $conn = $connClass->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_COLUMN,0);
        $fetch = $stmt->fetchAll();
        


    }
}
