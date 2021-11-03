
@extends('layouts.main')

@section('title', 'Ponto')

@section('content')

<div class="form-group col-sm-6">
    {!! Form::label('email', 'E-mail:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'chrome-off']) !!}
</div>

@endsection