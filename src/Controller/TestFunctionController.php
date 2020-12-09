<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestFunctionController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function test() :Response{
        return $this->render("test/index.html");
    }
}
