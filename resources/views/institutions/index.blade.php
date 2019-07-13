@extends('templates.master')

@section('content-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif


    {!! Form::open(['route' => 'institution.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('institutions.form-fields', ['submit_name' => 'Cadastrar'])
    {!! Form::close() !!}


    @include('institutions.list', ['institutions_list' => $institutions])

@endsection
