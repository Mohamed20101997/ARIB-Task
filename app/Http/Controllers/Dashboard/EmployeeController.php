<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EmployeeInterface;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employeeInterface;

    public function __construct(EmployeeInterface $employeeInterface){

        $this->employeeInterface = $employeeInterface;
    }


    public function index()
    {
        return $this->employeeInterface->index();
    }

    public function create()
    {
        return $this->employeeInterface->create();
    }

    public function store(EmployeeRequest $request)
    {
        return $this->employeeInterface->store($request);
    }

    public function update(EmployeeRequest $request)
    {
        return $this->employeeInterface->update($request);
    }

    public function edit(Request $request, $id)
    {
        return $this->employeeInterface->edit($request, $id);
    }


    public function show(Request $request, $id)
    {
        return $this->employeeInterface->show($request, $id);
    }




    public function destroy(Request $request, $id)
    {
        return $this->employeeInterface->destroy($request, $id);
    }
}
