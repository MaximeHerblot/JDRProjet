<?php

// src/Controller/CreationController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Creation {
    
    /**
     *
     * @Route ("/creation") 
     */
    public function base () :Response {

        $creation = 1;
        return new Response("ICI la partie creation");
    }
}