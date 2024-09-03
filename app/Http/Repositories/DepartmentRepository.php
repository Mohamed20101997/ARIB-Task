<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\DepartmentInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentInterface
{


    /**
     * @var Department $departmentModel
     */
    private $departmentModel;

    /**
     * DepartmentRepository constructor.
     * @param Department $department
     */
    public function __construct(Department $department){
        $this->departmentModel = $department;
    }

    public function index()
    {
        $departments = $this->departmentModel::whenSearch(request()->all())->with('departmentEmployees:id,department_id,salary')->simplePaginate(5);
        return view('dashboard.departments.index',compact('departments'));

    }//end of index function


    public function create()
    {

        return view('dashboard.departments.create');

    } //end of create function


    public function store($request)
    {
        try{
            $data = $request->except('_token');

            $this->departmentModel->create($data);

            session()->flash('success', 'Department added successfully');

            return redirect()->route('department.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } //end of store function


    public function edit($request,$id)
    {
        $department = $this->departmentModel::find($id);

        if($department){
            return view('dashboard.departments.edit', compact('department'));
        }else{
            return redirect()->back()->with(['error'=>'this department is not found']);
        }

    } //end of edit function

    public function update( $request)
    {
        try{

            $department =  $this->departmentModel->find($request->id);
            $data = $request->except('_token');

            $department->update($data);

            session()->flash('success', 'Department Updated successfully');

            return redirect()->route('department.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }
    } //end of update function

    public function destroy($request, $id)
    {
        try{
            $department =  $this->departmentModel->find($id);

            if(!$department)
            {
                return redirect()->back()->with(['error'=>'department not found']);
            }

            if ($department->departmentEmployees()->count() > 0) {
                return redirect()->back()->with(['error' => 'Cannot delete department with assigned employees.']);
            }

            $department->delete();

            session()->flash('success', 'Department deleted successfully');

            return redirect()->route('department.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } // end of destroy function
}
