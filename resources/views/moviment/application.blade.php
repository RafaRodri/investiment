@extends('templates.master')


@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::open(['route' => 'moviment.application.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('moviment.form-fields', ['submit_name' => 'Aplicar'])
    {!! Form::close() !!}

@endsection()
