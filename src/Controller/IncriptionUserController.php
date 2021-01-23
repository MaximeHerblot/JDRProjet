<?php

namespace App\Controller;

use App\Entity\User;
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

    /**
     * @Route("/incription/user/requete", name="requete_incription")
     */

    public function creationAccount(UserPasswordEncoderInterface $passwordInterface){
        $emailEnvoye=($_POST["email"]);
        $passwordEnvoye=($_POST["password"]);
        
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

        return new Response("Veuillez retourné en arriere");
        // $conn = new PDO("mysql:host=localhost;dbname=dndprojet","root","");
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $stmt = $conn->prepare("INSERT INTO user (email ,password ) VALUES ('$emailEnvoye','$passwordEnvoye')");
        // $stmt->execute();
        
    }
    
}
