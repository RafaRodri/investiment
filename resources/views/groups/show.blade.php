@extends('templates.master')

@section('content-view')

    <h1>Nome do grupo: {{ $group->name }}</h1>
    <h3>Instituição: {{ $group->institution->name }}</h3>
    <h3>Responsável: {{ $group->owner->name }}</h3>

    {!! Form::open(['route' => ['group.user.store', $group->id], 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formularios.select', [
            'select' => 'user_id',
            'label' => 'Usuário',
            'attributes' => [
                'placeholder' => 'Usuário'
            ],
            'data' => $users,
        ])

        @include('templates.formularios.submit', [
            'input' => 'Relacionar ao grupo "' . $group->name . '"'
        ])
    {!! Form::close() !!}

    @include('user.list', ['user_list' => $group->users])

@endsection()

