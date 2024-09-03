@extends('layouts.dashboard.app')

@section('content')

    <h1>Department</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item" active>Department</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb-4">
                <form action="{{ route('department.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" autofocus name="name" placeholder="search name" class="form-control" value="{{ request()->name }}">
                            </div>
                        </div><!-- end of col 4 -->

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <a href="{{ route('department.index') }}" class="btn btn-info"><i class="fa fa-refresh"></i></a>
                            <a href="{{ route('department.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div> <!-- end of col 12 -->

                    </div> <!-- end of row -->
                </form> <!-- end of form -->
                <div class="row">
                    <div class="col-md-12">
                        @if ($departments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Count Of Employees</th>
                                        <th>Sum Of Salary</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($departments as $index=>$department)
                                        <tr>
                                            <td>{{ $index+1 }}</td>

                                            <td>{{$department->name}}</td>


                                            <td>
                                                <h5 style="display: inline-block"><span class="badge badge-info p-2">{{ optional($department->departmentEmployees)->count() }}</span></h5>
                                            </td>

                                            <td>
                                                <h5 style="display: inline-block"><span class="badge badge-primary p-2">{{ optional($department->departmentEmployees)->sum('salary') }}</span></h5>
                                            </td>

                                            <td>
                                                <a href="{{ route('department.edit', $department->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <form method="post" action={{ route('department.destroy', $department->id)}} style="display:inline-block">
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
                            {{ $departments->appends(request()->query())->links() }}

                        @else
                            <h3 class="alert alert-info text-center d-flex justify-content-center" style="margin: 0 auto; font-weight: 400"><i class="fa fa-exclamation-triangle"></i> No Data To Display</h3>
                        @endif
                    </div> <!-- end of col-md-12 -->
                </div> <!-- end of row -->

            </div> <!-- end of tile -->

        </div> {{-- end of col  --}}
    </div> {{-- end of row  --}}
@endsection
