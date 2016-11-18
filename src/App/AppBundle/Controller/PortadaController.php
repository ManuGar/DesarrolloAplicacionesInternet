<?php

namespace App\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of PortadaController
 *
 * @author master
 */
class PortadaController extends Controller {
    public function showAction(){
            return $this->render("AppAppBundle:corredores:portada.html.twig");  
    }
}
