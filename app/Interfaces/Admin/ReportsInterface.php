<?php
namespace App\Interfaces\Admin;

interface ReportsInterface
{
    public function index();
    public function getSupplierReports($data,$filter = null);
    // public function find($id);
    public function UpdateNote($data,$id,$notes);
    // public function getServantsReports();
}
