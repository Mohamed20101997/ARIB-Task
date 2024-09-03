@extends('layouts.dashboard.app')

@section('content')

    <h1>Employee</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item" active>Employee</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb-4">
                <form action="{{ route('employee.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" autofocus name="first_name" placeholder="search First Name" class="form-control" value="{{ request()->first_name }}">
                            </div>
                        </div><!-- end of col 3 -->

                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" autofocus name="last_name" placeholder="search Last Name" class="form-control" value="{{ request()->last_name }}">
                            </div>
                        </div><!-- end of col 4 -->

                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" autofocus name="salary" placeholder="search Salary" class="form-control" value="{{ request()->salary }}">
                            </div>
                        </div><!-- end of col 4 -->

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <a href="{{ route('employee.index') }}" class="btn btn-info"><i class="fa fa-refresh"></i></a>
                            <a href="{{ route('employee.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div> <!-- end of col 12 -->

                    </div> <!-- end of row -->
                </form> <!-- end of form -->
                <div class="row">
                    <div class="col-md-12">
                        @if ($employees->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Salary</th>
                                        <th>Manager Name</th>
                                        <th>Department</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($employees as $index=>$employee)
                                        <tr>
                                            <td>{{ $index+1 }}</td>

                                            <td>{{$employee->full_name}}</td>
                                            <td>
                                                <h5 style="display: inline-block"><span class="badge badge-primary p-2">{{ $employee->salary}}</span></h5>
                                            </td>

                                            <td>{{$employee->manager_name}}</td>
                                            <td>{{ optional($employee->employeeDepartment)->name}}</td>

                                            <td>
                                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                <form method="post" action={{ route('employee.destroy', $employee->id)}} style="display:inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                                                </form> <!-- end of form -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $employees->appends(request()->query())->links() }}

                        @else
                            <h3 class="alert alert-info text-center d-flex justify-content-center" style="margin: 0 auto; font-weight: 400"><i class="fa fa-exclamation-triangle"></i> No Data To Display</h3>
                        @endif
                    </div> <!-- end of col-md-12 -->
                </div> <!-- end of row -->

            </div> <!-- end of tile -->

        </div> {{-- end of col  --}}
    </div> {{-- end of row  --}}
@endsection
