<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\ConnectionBdClass;
use InscriptionUsersControllerTest;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class IncriptionUserController extends AbstractController
{
    protected $passwordInterface;
    
    /**
     * @Route("/incription/user", name="incription_user")
     */
    public function index(): Response
    {
        return $this->render('incription_user/index.html.twig', [
            'controller_name' => 'IncriptionUserController',
        ]);
    }




    public function verification_name_user_not_taken($email) {
        $classConn = new ConnectionBdClass();
        $conn = $classConn->getConnection();

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt= $conn->prepare("SELECT `email` FROM `user` WHERE email LIKE '$email' ");
        $stmt ->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'User');

        $fetch = $stmt->fetchAll();
        if (count($fetch)) {
            return True;
        } else {
            return False;
        }
    }

    public function verif_info_donne($email,$password){

        $passwordBonFormat = 0;
        $emailBonFormat = 0;
        if (is_string($password)) {
            $passwordBonFormat = 1;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailBonFormat = 1;
        }
        if ($emailBonFormat and $passwordBonFormat) {
            return True;
        } else {
            return False;
        }
    }

    /**
     * @Route("/incription/user/requete", name="requete_incription")
     */

    public function creationAccount(UserPasswordEncoderInterface $passwordInterface){
        $emailEnvoye=($_POST["email"]);
        $passwordEnvoye=($_POST["password"]);
        
        $this->verification_name_user_not_taken($emailEnvoye);
        $this->verif_info_donne($emailEnvoye,$passwordEnvoye);
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setEmail($emailEnvoye);
        $user->setPassword($passwordInterface->encodePassword(
            $user,
            $passwordEnvoye
        ));
        $user->setRoles(["ROLE_USER"]);
        $em->persist($user);
        $em->flush();
        
        //Retour d'une réponse pour dire que le compte est bien créer
        return $this->render('incription_user/requete.html.twig',[
            'emailUser'=> $emailEnvoye,
        ]);
        return new Response("Veuillez retourné en arriere");
        // $conn = new PDO("mysql:host=localhost;dbname=dndprojet","root","");
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $stmt = $conn->prepare("INSERT INTO user (email ,password ) VALUES ('$emailEnvoye','$passwordEnvoye')");
        // $stmt->execute();
        
    }
    
    
}
