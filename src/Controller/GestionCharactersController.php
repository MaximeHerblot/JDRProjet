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
        //Récupération des personnages existants
        $characters = $this->getDoctrine()->getRepository(Characters::class)->findAll();
        


        return $this->render('gestion_characters/index.html', [
            'controller_name' => 'GestionPersonnageController',
            'characters' => $characters
        ]);
    }
}
