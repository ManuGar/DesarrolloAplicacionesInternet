<?php
namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Participante;
Use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Corredor;

interface IParticipanteRepository {
   public function inscribirParticipante(Participante $participante);
   public function findAllParticipacionesCorredoresCarrera();
   public function findAllParticipantesCarrera(Carrera $carrera);
   public function findAllCarrerasDisputadasCorredor(Corredor $corredor);
   public function findAllCarrerasInscritasCorredor(Corredor $corredor);
   public function isCorredorInCarrera(Corredor $corredor, Carrera $carrera);
   public function updateTiempoCorredorCarrera($corredor, $tiempo);
   public function deleteParticipacion(Corredor $corredor,Carrera $carrera);
   
   
}
