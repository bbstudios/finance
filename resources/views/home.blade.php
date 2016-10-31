@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>
                    <a class="btn btn-danger btn-sm" href="{{url('/',['register'])}}?ref={{encrypt($user->id)}}" target="_blank">reference link</a><br>
                    Uplevel: {{$uplevel->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
