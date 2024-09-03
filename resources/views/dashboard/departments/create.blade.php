@extends('layouts.dashboard.app')

@section('content')
    <h1>Departments</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('department.index') }}">Departments</a></li>
        <li class="breadcrumb-item" active>Add</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('department.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row mt-4 ">
                        <div class="col-md-4">
                            {{-- name --}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="name" class="form-control" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col name --}}


                    </div> {{-- end of row --}}


                    <hr class="mt-4 mb-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                    </div>
                </form>

            </div> {{-- end of tile --}}

        </div> {{-- end of col --}}
    </div> {{-- end of row --}}


@endsection
