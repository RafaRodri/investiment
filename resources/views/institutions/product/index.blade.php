@extends('templates.master')

@section('content-view')

    <header>
        <h1>{{ $institution->name }}</h1>
    </header>

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::open(['route' => ['institution.product.store', $institution], 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('institutions.product.form-fields', ['submit_name' => 'Cadastrar'])
    {!! Form::close() !!}

    @include('institutions.product.list', ['institution' => $institution])

@endsection
