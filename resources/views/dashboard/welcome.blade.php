@extends('layouts.dashboard.app')


@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Dashboard</a></li>
        </ul>
    </div>


@endsection
