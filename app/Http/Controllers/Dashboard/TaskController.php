<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\TaskInterface;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskInterface;

    public function __construct(TaskInterface $taskInterface){

        $this->taskInterface = $taskInterface;
    }


    public function index()
    {
        return $this->taskInterface->index();
    }

    public function create()
    {
        return $this->taskInterface->create();
    }

    public function store(TaskRequest $request)
    {
        return $this->taskInterface->store($request);
    }

    public function update(TaskRequest $request)
    {
        return $this->taskInterface->update($request);
    }

    public function edit(Request $request, $id)
    {
        return $this->taskInterface->edit($request, $id);
    }

    public function updateTaskStatuses(Request $request, $id)
    {
        return $this->taskInterface->updateTaskStatuses($request, $id);
    }

    public function destroy(Request $request, $id)
    {
        return $this->taskInterface->destroy($request, $id);
    }
}
