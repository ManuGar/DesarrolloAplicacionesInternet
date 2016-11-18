<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of OrganizacionController
 *
 * @author magarcd
 */
class OrganizacionController extends Controller {

    public function findBySlugAction($slug) {
        $organizacion = $this->get('organizacionrepository')->findBySlug($slug);
        //return new Response( $organizacion);
        $carrOrgDis = $this->get('carrerarepository')->findByOrgDisputadas($organizacion);
        $carrOrgNoDis = $this->get('carrerarepository')->findByOrgNoDisputadas($organizacion);

        return $this->render("AppAppBundle:corredores:organizacion.html.twig", array('organizacion' => $organizacion,'carrOrgDis'=>$carrOrgDis,'carrOrgNoDis'=>$carrOrgNoDis));
    }

}
