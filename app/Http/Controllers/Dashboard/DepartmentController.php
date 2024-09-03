<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Interfaces\DepartmentInterface;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    private $departmentInterface;

    public function __construct(DepartmentInterface $departmentInterface){

        $this->departmentInterface = $departmentInterface;
    }


    public function index()
    {
        return $this->departmentInterface->index();
    }

    public function create()
    {
        return $this->departmentInterface->create();
    }

    public function store(DepartmentRequest $request)
    {
        return $this->departmentInterface->store($request);
    }

    public function update(DepartmentRequest $request)
    {
        return $this->departmentInterface->update($request);
    }

    public function edit(Request $request, $id)
    {
        return $this->departmentInterface->edit($request, $id);
    }

    public function destroy(Request $request, $id)
    {
        return $this->departmentInterface->destroy($request, $id);
    }
}
