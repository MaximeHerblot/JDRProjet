<?php

use App\Controller\IncriptionUserController;
use App\Service\ConnectionBdClass;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class IncriptionUserControllerTest extends TestCase{
    
    /**
     * @test
     */
    public function verification_name_user_not_taken_test(){
        //On a un email utilisateur
        $faker = Faker\Factory::create();
        $email = $faker->email();
        //Que l'on cherche a savoir si il existe déja 

        $controller = new IncriptionUserController();
        $emailAlreadyUseForEmailGenerated = $controller->verification_name_user_not_taken($email);
        //Regarde si la fonction fait bien sont travaille
        assertEquals(False,$emailAlreadyUseForEmailGenerated);

        //Récupération d'un mail utilisateur dans la base de données
        $classConn = new ConnectionBdClass();
        $conn = $classConn->getConnection();

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt= $conn->prepare("SELECT `email` FROM `user`");
        $stmt ->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,'User');

        $fetch = $stmt->fetchAll();

        $emailRecup = $fetch[0]["email"];
        // dd($emailRecup);
        $emailAlreadyUseForEmailRecup = $controller->verification_name_user_not_taken($emailRecup);
        assertEquals(True,$emailAlreadyUseForEmailRecup);

    }

    /**
     * @test
     */
    public function verif_info_donne_test(){

        //On a un email et un mot de passe 
        $faker = Faker\Factory::create();
        $email = $faker->email();
        $nom = $faker->name();
        $password  = $faker->password();

        $controller = new IncriptionUserController();
        $controller->verif_info_donne($email,$password);

        assertEquals(True,$controller->verif_info_donne($email,$password));
        assertEquals(False,$controller->verif_info_donne($email,1));
        assertEquals(False,$controller->verif_info_donne($nom,$password));
    }
}