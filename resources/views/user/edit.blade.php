@extends('templates.master')


@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif


    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('user.form-fields', ['submit_name' => 'Atualizar'])
    {!! Form::close() !!}
@endsection()
