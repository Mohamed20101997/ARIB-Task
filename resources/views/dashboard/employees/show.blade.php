@extends('layouts.dashboard.app')

@section('content')
    <h1>Employee Details</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee</a></li>
        <li class="breadcrumb-item" active>Show</li>
    </ul>

    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <!-- Employee Details -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>First Name:</strong></label>
                            <p>{{ $employee->first_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Last Name:</strong></label>
                            <p>{{ $employee->last_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Salary:</strong></label>
                            <p>{{ $employee->salary }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Department:</strong></label>
                            <p>{{ optional($employee->employeeDepartment)->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tasks Assigned to Employee -->
                <h4>Assigned Tasks</h4>
                <form method="POST" action="{{ route('employee.updateTasks', $employee->id) }}">
                    @csrf
                    @method('put')

                    <div class="row">
                        @foreach($employee->tasks as $task)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $task->task_name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $task->description }}</p>
                                        <div class="form-group">
                                            <label><strong>Status:</strong></label>
                                            <select name="task_status[{{ $task->pivot->id }}]" class="form-control">
                                                <option value="pending" {{ $task->pivot->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $task->pivot->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $task->pivot->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Update Task Statuses</button>
                    </div>
                </form>

                <!-- Optional: Button to go back or edit -->
                <div class="form-group mt-4">
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back to List</a>
                </div>
            </div> {{-- end of tile --}}
        </div> {{-- end of col --}}
    </div> {{-- end of row --}}
@endsection
