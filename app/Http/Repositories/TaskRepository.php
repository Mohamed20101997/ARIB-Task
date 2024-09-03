<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\TaskInterface;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskInterface
{


    private $taskModel;
    private $employeeTaskModel;


    public function __construct(Task $task , EmployeeTask $employeeTask){
        $this->taskModel = $task;
        $this->employeeTaskModel = $employeeTask;
    }

    public function index()
    {
        $tasks = $this->taskModel::whenSearch(request()->all())->with('employees')->simplePaginate(5);
        return view('dashboard.tasks.index',compact('tasks'));

    }//end of index function


    public function create()
    {
        $employees = Employee::get();
        return view('dashboard.tasks.create' , compact('employees'));

    } //end of create function


    public function store($request)
    {
        try{
            DB::beginTransaction();
            $data = $request->except('_token');
            $task = $this->taskModel->create($data);

            if ($request->filled('employee_ids')) {
                $task->employees()->sync($request->employee_ids);
            }

            DB::commit();
            session()->flash('success', 'Task added successfully');
            return redirect()->route('task.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } //end of store function


    public function edit($request,$id)
    {
        $task = $this->taskModel::find($id);
        $employees = Employee::get();
        if($task){
            return view('dashboard.tasks.edit', compact('task','employees'));
        }else{
            return redirect()->back()->with(['error'=>'this task is not found']);
        }

    } //end of edit function

    public function update($request)
    {
        try {
            DB::beginTransaction();

            $task = $this->taskModel->find($request->id);

            $data = $request->except('_token', 'employee_ids'); // Exclude '_token' and 'employee_ids'
            $task->update($data);

            if ($request->has('employee_ids')) {
                $task->employees()->sync($request->employee_ids);
            } else {
                $task->employees()->detach();
            }

            DB::commit();

            session()->flash('success', 'Task updated successfully');
            return redirect()->route('task.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'There is a problem, please try again']);
        }
    }

    public function destroy($request, $id)
    {
        try{
            $task =  $this->taskModel->find($id);

            if(!$task)
            {
                return redirect()->back()->with(['error'=>'task not found']);
            }

            $task->delete();

            session()->flash('success', 'Task deleted successfully');

            return redirect()->route('task.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'there is problem please try again']);
        }

    } // end of destroy function


    public function updateTaskStatuses($request, $employeeId)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::findOrFail($employeeId);

            if ($request->has('task_status')) {
                foreach ($request->task_status as $pivotId => $status) {
                    $employeeTask = $employee->tasks()->wherePivot('id', $pivotId)->first();
                    if ($employeeTask) {
                        $employee->tasks()->updateExistingPivot($employeeTask->pivot->task_id, ['status' => $status]);
                    }
                    $checkTaskEmployeeStatus = $this->employeeTaskModel::where([['task_id',$employeeTask->id],['status','completed']])->get();
                    if(count($checkTaskEmployeeStatus) > 0){
                        $task = $this->taskModel->find($employeeTask->id);
                        if($task){
                            $task->update(
                                ['status'=>'completed']
                            );
                        }

                    }

                }

            }

            DB::commit();
            session()->flash('success', 'Task statuses updated successfully');
            return redirect()->route('employee.show', $employeeId);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error in updating task statuses: ' . $e->getMessage());
            return redirect()->back()->with(['error' => 'There was a problem, please try again']);
        }
    }



}
