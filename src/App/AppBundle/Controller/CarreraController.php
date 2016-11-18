<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CarreraController extends Controller {

    public function findAllAction() {
        //$carreras = $this -> get('carrerarepository') -> findAll();    
        //return new Response(implode("<br/>", $carreras));
        $carrerasDis = $this->get('carrerarepository')->findCarrerasDisputadas();
        $carrerasNoDis = $this->get('carrerarepository')->findCarrerasNoDisputadas();
        

        return $this->render("AppAppBundle:corredores:carreras.html.twig", 
                array('carrerasDis' => $carrerasDis,'carrerasNoDis' => $carrerasNoDis));
    }

    public function findBySlugAction($slug) {
        $carrera = $this->get('carrerarepository')->findBySlug($slug);
        $participantes  = $this->get('participanterepository')->findAllParticipantesCarrera($carrera);
        //return new Response($carrera);
        return $this->render("AppAppBundle:corredores:carrera.html.twig", 
                array('carrera' => $carrera,'participantes'=>$participantes));
    }

}
