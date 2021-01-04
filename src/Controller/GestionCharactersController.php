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

    /**
     * @Route("/gestion/characters/{id}")
     */
    public function pageEdition(int $id):Response
    {
        //Récupération de tout les personnages 
        //Si le personnage qui correspond a cette id appartient a l'user alors on lui donne acces 
        $characters= $this->getDoctrine()
           ->getRepository(Characters::class)
           ->find($id);
        $this->getUser();
        if ($this->getUser() == $characters->getUser()) {
            return $this->render('gestion_characters/pageEdition.html', [
                'controller_name' => 'GestionPersonnageController',
                'characters' => $characters
            ]);
        } else {
            return new Response("Vous ne posseder pas le personnage");
        }
        

        
    }
}
