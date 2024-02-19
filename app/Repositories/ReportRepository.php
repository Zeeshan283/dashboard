<?php
namespace App\Repositories;

use App\Repositories\Interface\ReportRepositoryInterface;
use App\Models\Report;

class ReportRepository implements ReportRepositoryInterface{
    public function index(){
        return Report::all();
    }public function show($id){
        return Report::findOrFail($id);
    }
}
