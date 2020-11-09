<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationCharactersController extends AbstractController
{
    /**
     * @Route("/creation/characters", name="creation_characters")
     */
    public function index(): Response
    {
        return $this->render('creation_characters/index.html', [
            'controller_name' => 'CreationCharactersController',
        ]);
    }
}
