@extends('templates.master')


@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif


    {!! Form::model($institution, ['route' => ['institution.update', $institution->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
    @include('institutions.form-fields', ['submit_name' => 'Atualizar'])
    {!! Form::close() !!}
@endsection()
