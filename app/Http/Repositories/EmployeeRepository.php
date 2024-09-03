<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\EmployeeInterface;
use App\Models\Department;
use App\Models\Employee;

class EmployeeRepository implements EmployeeInterface
{

    /**
     * @var Employee $employeeModel
     */
    private $employeeModel;

    /**
     * EmployeeRepository constructor.
     * @param Employee $employee
     */
    public function __construct(Employee $employee){
        $this->employeeModel = $employee;
    }

    public function index()
    {
        $employees = $this->employeeModel::whenSearch(request()->all())->simplePaginate(5);
        return view('dashboard.employees.index',compact('employees'));

    }//end of index function


    public function create()
    {
        $departments = Department::get();
        return view('dashboard.employees.create', compact('departments'));

    } //end of create function


    public function store($request)
    {
        try{
            $data = $request->except('_token');

            if ($request->has('image')) {
                $data['image'] = uploadImage('public_uploads', $request->file('image'));
            }
            $this->employeeModel->create($data);
            session()->flash('success', 'Employee added successfully');

            return redirect()->route('employee.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } //end of store function


    public function edit($request,$id)
    {
        $employee = $this->employeeModel::find($id);
        $departments = Department::get();

        if($employee){
            return view('dashboard.employees.edit', compact('employee','departments'));
        }else{
            return redirect()->back()->with(['error'=>'this employee is not found']);
        }

    } //end of edit function

    public function show($request, $id)
    {
        $employee = $this->employeeModel::find($id);

        if($employee){
            return view('dashboard.employees.show', compact('employee'));
        }else{
            return redirect()->back()->with(['error'=>'this employee is not found']);
        }

    }


    public function update( $request)
    {

        try{
            $employee =  $this->employeeModel->find($request->id);
            $data = $request->except('_token');

            if ($request->has('image')) {
                remove_previous('public_uploads',$employee);
                $data['image'] = uploadImage('public_uploads', $request->file('image'));
            }

            $employee->update($data);

            session()->flash('success', 'Employee Updated successfully');

            return redirect()->route('employee.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } //end of update function

    public function destroy($request, $id)
    {
        try{
            $employee =  $this->employeeModel->find($id);

            if(!$employee)
            {
                return redirect()->back()->with(['error'=>'employee not found']);
            }

            $employee->delete();
            remove_previous('public_uploads',$employee);

            session()->flash('success', 'Employee deleted successfully');

            return redirect()->route('employee.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } // end of destroy function




}
