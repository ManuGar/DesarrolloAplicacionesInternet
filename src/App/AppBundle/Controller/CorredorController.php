<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\AppBundle\Form\CorredorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\CorredoresRiojaDomain\Model\Participante;

/**
 * Description of CorredorController
 *
 * @author magarcd
 */
class CorredorController extends Controller {

    public function findAllAction() {
        $corredores = $this->get('corredorrepository')->findAll();
        /* return $this->render("AppAppBundle:corredores:portada.html.twig",
          array('corredores'=>$corredores));
         */
        return new Response(implode("<br/>", $corredores));
    }

    public function registroAction(Request $peticion) {
        $form = $this->createForm(CorredorType::class);
        $form->add('registro', SubmitType::class, array('label' => 'Registro'));
        $form->handleRequest($peticion);

        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
// Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            $password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            //$corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('corredorrepository')->registraCorredor($corredor);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getNombre() . ' te has registrado en CorredoresPorLaRioja!');
            // Reedirigimos al usuario a la portada
            //return $this->redirect($this->generateUrl('portada'));
            return $this->render("AppAppBundle:corredores:portada.html.twig");
        }
        return $this->render("AppAppBundle:corredores:registro.html.twig", array('formulario' => $form->createView()));
    }

    public function perfilAction(Request $peticion) {
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        throw $this->createAccessDeniedException();
        }       
        $user = $this->getUser();
        $corredor = $this->get('corredorrepository')->buscaCorredor($user->getUsername());
        $form = $this->createForm(CorredorType::class, $corredor);
        $form->add('registro', SubmitType::class, array('label' => 'Guardar'));
        $form->handleRequest($peticion);

        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
            // Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            $password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            //$corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('corredorrepository')->registraCorredor($corredor);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getNombre() . ' te has registrado en CorredoresPorLaRioja!');
            // Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('portada'));
        }
        return $this->render("AppAppBundle:corredores:registro.html.twig", array('formulario' => $form->createView()));
    }
    
    public function miscarrerasAction() {
             
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        $corredor = $this->get('corredorrepository')->buscaCorredor($user->getUsername());
        $carrerasNoDis = $this->get('participanterepository')->findAllCarrerasInscritasCorredor($corredor);
        $carrerasDis = $this->get('participanterepository')->findAllCarrerasDisputadasCorredor($corredor);

        return $this->render("AppAppBundle:corredores:miscarreras.html.twig", array('corredor' => $corredor,"carrerasNoDis"=>$carrerasNoDis,"carrerasDis"=>$carrerasDis));
    }
    
    public function inscribirAction($slug) {
             
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        $corredor = $this->get('corredorrepository')->buscaCorredor($user->getUsername());
        $carrera = $this->get('carrerarepository')->findBySlug($slug);
        $participante = new Participante(rand(1, 100)+"", "06:28:23", $corredor, $carrera);
        $this->get('participanterepository')->inscribirParticipante($participante);

        $carrerasNoDis = $this->get('participanterepository')->findAllCarrerasInscritasCorredor($corredor);
        $carrerasDis = $this->get('participanterepository')->findAllCarrerasDisputadasCorredor($corredor);

        return $this->render("AppAppBundle:corredores:miscarreras.html.twig", array('corredor' => $corredor,"carrerasNoDis"=>$carrerasNoDis,"carrerasDis"=>$carrerasDis));
    }
    
    public function desapuntarAction($slug) {
             
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        $corredor = $this->get('corredorrepository')->buscaCorredor($user->getUsername());
        $carrera = $this->get('carrerarepository')->findBySlug($slug);
        $this->get('participanterepository')->deleteParticipacion($corredor,$carrera);
        $carrerasNoDis = $this->get('participanterepository')->findAllCarrerasInscritasCorredor($corredor);
        $carrerasDis = $this->get('participanterepository')->findAllCarrerasDisputadasCorredor($corredor);
     
        return $this->render("AppAppBundle:corredores:miscarreras.html.twig", array('corredor' => $corredor,"carrerasNoDis"=>$carrerasNoDis,"carrerasDis"=>$carrerasDis));
    }

}
