<?php

namespace App\Controller;

use App\Service\ConnectionBdClass;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationGroupController extends AbstractController
{
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
        $classConn= new ConnectionBdClass();
        $conn = $classConn->getConnection();
        //Execution de la requete sql
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `group` (`name_group`, `user_id`) 
        VALUES ('$nameGroup',".$userId.")";
        $conn->exec($sql);
        
        //Récupération de l'id du groupe qui vient d'être créer
        $sql = "SELECT id FROM `group` WHERE name_group LIKE '".$nameGroup."' AND user_id LIKE ".$userId."";
        // $sql = "SELECT id FROM group WHERE name_group LIKE '".$nameGroup."' AND userId LIKE '".$userId."'"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_COLUMN ,0);
        $fetch = $stmt->fetchAll();
        $group_id =  ($fetch[count($fetch)-1]);
        //Parcours de la liste des characters

        foreach ($_POST["listIdCharacters"] as $charactersId) {
            $sql = "UPDATE `characters` SET `groupe_id` = ".$group_id." WHERE id = ".$charactersId;
            $conn->exec($sql);
        }
        
    }
}
