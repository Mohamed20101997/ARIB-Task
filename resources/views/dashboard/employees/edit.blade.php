@extends('layouts.dashboard.app')

@section('content')
    <h1>Employee</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee</a></li>
        <li class="breadcrumb-item" active>Edit</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$employee->id}}">
                    @csrf
                    @method('put')

                    <div class="row mt-4 ">


                        <div class="col-md-4">
                            {{-- first_name --}}
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" placeholder="first name" class="form-control" required value="{{ old('first_name',$employee->first_name) }}">
                                @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col first_name --}}


                        <div class="col-md-4">
                            {{-- last_name --}}
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" placeholder="last name" class="form-control" required value="{{ old('last_name',$employee->last_name) }}">
                                @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col last_name --}}


                        <div class="col-md-4">
                            {{-- salary --}}
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="number" step="0.00" name="salary"  class="form-control" required value="{{ old('salary', $employee->salary) }}">
                                @error('salary')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col salary --}}


                    </div> {{-- end of row --}}

                    <div class="row">

                        <div class="col-md-4">
                            {{-- image --}}
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" >
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col image --}}


                        <div class="col-md-4">
                            {{-- manager_name --}}
                            <div class="form-group">
                                <label>Manager Name</label>
                                <input type="text" name="manager_name"  class="form-control"  value="{{ old('manager_name' , $employee->manager_name) }}">
                                @error('manager_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col manager_name --}}


                        <div class="col-md-4">
                            {{-- department --}}
                            <div class="form-group">
                                <label>Department Name</label>

                                <select name="department_id" class="form-control select2">
                                    <option value="">Select Department</option>
                                    @if(isset($departments) && count($departments) > 0)
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{old('department_id', $employee->department_id) == $department->id ? 'selected' : ''}}>{{$department->name}}</option>
                                        @endforeach
                                    @endif

                                </select>

                                @error('department_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col department --}}



                    </div> {{-- end of row --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Update</button>
                    </div>
                </form>

            </div> {{-- end of tile  --}}

        </div> {{-- end of col  --}}
    </div> {{-- end of row  --}}


@endsection

