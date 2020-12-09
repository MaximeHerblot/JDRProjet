<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Extension\HttpFoundationExtension;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(): Response
    {
        
        if ($this->getUser()==null) {
            return $this->redirectToRoute('app_login');
            // $this->redirect("/login");
        } else {
            
            return $this->render('home/home.html.twig');
        }
        
    }
    
}
