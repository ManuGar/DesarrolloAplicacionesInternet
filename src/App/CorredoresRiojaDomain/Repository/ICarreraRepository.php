<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;
interface ICarreraRepository {
    public function newCarrera($id,$nom,$fecCele,$dis,$fechLimIns, $NumMaxPart, $img, $des, Organizacion $org);  
    public function updateCarrera(Carrera $carrera);
    public function deleteCarrera(Carrera $carrera);
    public function findBySlug($slug);
    public function findByOrgDisputadas(Organizacion $org);
    public function findByOrgNoDisputadas(Organizacion $org);
    public function findAll();
    public function findCarrerasDisputadas();
    public function findCarrerasNoDisputadas();
    
}
