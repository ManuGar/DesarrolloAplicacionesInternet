<?php
namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Organizacion;
interface IOrganizacionRepository {
    public function regOrganizacion(Organizacion $organizacion);
    public function updateOrganizacion(Organizacion $organizacion);
    public function deleteOrganizacion(Organizacion $organizacion);
    public function findBySlug($slug);
    public function findByEmail($email);
    public function findAll();
}
