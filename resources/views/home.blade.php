@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        {!! Form::open(['url'=>'earn']) !!}
                        <table class="table table-striped">
                            <tr><td class="col-sm-4">reference link</td><td class="col-sm-8"><a href="{{url('/',['register'])}}?ref={{encrypt($user->id)}}">Link</a> </td></tr>
                           @if(isset($uplevel->name))
                            <tr><td>Uplevel</td><td>{{$uplevel->name}}</td></tr>
                            @endif
                            <tr><td>Credit</td><td>{{$user->credit}}</td></tr>
                            <tr><td>Earn</td><td>

                                    {!! Form::number('credit',0,['class'=>'form-control','step'=>0.01]) !!}
                                </td></tr>
                        </table>
                        {!! Form::close() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
