<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionGroupController extends AbstractController
{
    /**
     * @Route("/gestion/group", name="gestion_groupe")
     */
    public function index(): Response
    {
        //Récupération des groupes de l'utilisateur identifié
        $listGroup = $this->getUser()->getGroupOwner();
        return $this->render('gestion_group/index.html.twig', [
            'controller_name' => 'GestionGroupController',
            'listGroup' => $listGroup,
        ]);
    }
}
