<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\DataBinder\RaceData;

class InitiationController extends AbstractController
{
    /**
     * @Route("/initiation", name="initiation")
     */
    public function index(): Response
    {
        //Initialisation de toutes les variables nécessaires dans la bse de données
        $raceData = new RaceData($this->getDoctrine()->getManager());


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
        ($raceData->pushListRace($this->getDoctrine()->getManager()));
        

        return $this->render('initiation/index.html.twig', [
            'controller_name' => 'InitiationController',
        ]);
    }
}
