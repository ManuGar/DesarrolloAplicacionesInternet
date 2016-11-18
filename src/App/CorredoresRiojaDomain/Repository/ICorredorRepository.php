<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Corredor;

interface ICorredorRepository {
    public function registraCorredor(Corredor $Corredor);
    public function updateCorredor(Corredor $Corredor);
    public function deleteCorredor(Corredor $Corredor);
    public function buscaCorredor($Dni);
    public function findAll();
}
