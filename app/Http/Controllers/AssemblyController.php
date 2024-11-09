<?php

namespace App\Http\Controllers;

use App\Models\Assembly;
use App\Models\Employee;
use Illuminate\Http\Request;

class AssemblyController extends Controller
{
    private $assemblyModel;
    private $employeeModel;

    public function __construct()
    {
        $this->assemblyModel = new Assembly();
        $this->employeeModel = new Employee();
    }
}