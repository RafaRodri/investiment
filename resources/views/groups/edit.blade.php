@extends('templates.master')

@section('content-view')
    {!! Form::model($group, ['route' => ['group.update', $group->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('groups.form-fields', ['submit_name' => 'Atualizar'])
    {!! Form::close() !!}


@endsection()

