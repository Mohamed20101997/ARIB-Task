@extends('layouts.dashboard.app')

@section('content')

    <h1>Tasks</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item" active>Tasks</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb-4">
                <form action="{{ route('task.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" autofocus name="task_name" placeholder="search task name" class="form-control" value="{{ request()->task_name }}">
                            </div>
                        </div><!-- end of col 4 -->

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <a href="{{ route('task.index') }}" class="btn btn-info"><i class="fa fa-refresh"></i></a>
                            <a href="{{ route('task.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div> <!-- end of col 12 -->

                    </div> <!-- end of row -->
                </form> <!-- end of form -->
                <div class="row">
                    <div class="col-md-12">
                        @if ($tasks->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Assigned Employees</th>

                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($tasks as $index=>$task)
                                        <tr>
                                            <td>{{ $index+1 }}</td>

                                            <td>{{$task->task_name}}</td>
                                            <td><p>{{ Str::limit($task->description, 40, '...') }}</p> </td>
                                            <td>{!! $task->status_format !!}</td>
                                            <td>
                                                <ul>
                                                    @forelse ($task->employees as $employee)
                                                        <li>{{ $employee->full_name }}</li>
                                                    @empty
                                                        <li>No employees assigned.</li>
                                                    @endforelse
                                                </ul>
                                            </td>

                                            <td>
                                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <form method="post" action={{ route('task.destroy', $task->id)}} style="display:inline-block">
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
                            {{ $tasks->appends(request()->query())->links() }}

                        @else
                            <h3 class="alert alert-info text-center d-flex justify-content-center" style="margin: 0 auto; font-weight: 400"><i class="fa fa-exclamation-triangle"></i> No Data To Display</h3>
                        @endif
                    </div> <!-- end of col-md-12 -->
                </div> <!-- end of row -->

            </div> <!-- end of tile -->

        </div> {{-- end of col  --}}
    </div> {{-- end of row  --}}
@endsection
