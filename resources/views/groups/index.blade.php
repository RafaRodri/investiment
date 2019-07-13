@extends('templates.master')

@section('content-view')
    {!! Form::open(['route' => 'group.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('groups.form-fields', ['submit_name' => 'Cadastrar'])
    {!! Form::close() !!}

    @include('groups.list', ['group_list' => $groups])

@endsection()

