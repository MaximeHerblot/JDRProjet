<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\DataBinder\RaceData;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InitiationController extends AbstractController
{
    /**
     * @Route("/initiation", name="initiation")
     */
    public function index(UserPasswordEncoderInterface $passwordInterface): Response
    {
        //Initialisation de toutes les variables nécessaires dans la bse de données
        $raceData = new RaceData();


        //Ajout de toutes les races qui sont nécessaires dans une liste
        $listRace = [];

        array_push($listRace,"Humain");
        array_push($listRace,"Elfe");
        array_push($listRace,"Nain");


        //ListRace remplit

        foreach ($listRace as $nom ) {
            $raceData->addRace($nom);
        }

        //Ajout dans la base de données des différents races
        $raceData->pushListRace();
        
        $user = new User();
        $user->setEmail("user@user.user");
        $user->setPassword($passwordInterface->encodePassword(
            $user,
            "user"
        ));
        $em->persist($user);
        $em->flush();



        return $this->render('initiation/index.html.twig', [
            'controller_name' => 'InitiationController',
        ]);
    }
}
