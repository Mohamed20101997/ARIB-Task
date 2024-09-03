@extends('layouts.dashboard.app')

@section('content')
    <h1>Tasks</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Tasks</a></li>
        <li class="breadcrumb-item" active>Add</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row mt-4 ">
                        <div class="col-md-4">
                            {{-- Task Name --}}
                            <div class="form-group">
                                <label>Task Name</label>
                                <input type="text" name="task_name" placeholder="name" class="form-control" required value="{{ old('task_name') }}">
                                @error('task_name')
                                    <div class="text-danger">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col  Task Name --}}


                        <div class="col-md-6">
                            {{-- employee --}}
                            <div class="form-group">
                                <label>Employee Name</label>
                                <select name="employee_ids[]" class="form-control select2"  multiple="multiple">

                                    <option value="" disabled>Select Employee</option>
                                    @if(isset($employees) && count($employees) > 0)
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}" {{old('employee_ids') == $employee->id ? 'selected' : ''}}>{{$employee->full_name}}</option>
                                        @endforeach
                                    @endif

                                </select>

                                @error('employee_ids')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col department --}}


                        <div class="col-md-2">
                            {{-- status --}}
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control select2" >
                                    <option value="pending" selected {{old('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="in_progress" {{old('status') == 'in_progress' ? 'selected' : ''}}>In Progress </option>
                                    <option value="completed" {{old('status') == 'completed' ? 'selected' : ''}}>Completed </option>
                                </select>

                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col department --}}




                    </div> {{-- end of row --}}


                    <div class="row">
                        <div class="col-md-12">
                            {{-- name --}}
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" placeholder="description" class="form-control" required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col name --}}

                    </div>

                    <hr class="mt-4 mb-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                    </div>
                </form>

            </div> {{-- end of tile --}}

        </div> {{-- end of col --}}
    </div> {{-- end of row --}}


@endsection
