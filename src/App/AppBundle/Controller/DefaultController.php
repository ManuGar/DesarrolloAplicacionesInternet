<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppAppBundle:Default:index.html.twig');
    }
    
    public function adminAction()
    {
        return new Response ('Página de administrador');
    }
    
}
