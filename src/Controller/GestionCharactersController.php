<?php

namespace App\Controller;

use App\Entity\Characters;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionCharactersController extends AbstractController
{
    /**
     * @Route("/gestion/characters", name="gestion_personnage")
     */
    public function index(): Response
    {

        // dd($this->getUser());

        //Récupération des personnages de l'utilisateur

        $characters = $this->getUser()->getCharacters();
        (($characters));
        


        return $this->render('gestion_characters/index.html', [
            'controller_name' => 'GestionPersonnageController',
            'characters' => $characters
        ]);
    }
}
