<?php

namespace App\Controller;

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

    public function creationGroup(){
        $_POST["userId"];
        $_POST["listIdCharacters"];

        
    }
}
