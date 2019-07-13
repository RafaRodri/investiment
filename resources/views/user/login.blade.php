@extends('templates.master')

@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')
    <div class="background"></div>

    <section id="content-view" class="login">
        <h1>Investindo</h1>
        <h3>O nosso gerenciador de investimentos</h3>

        <!--Chamar um método blade, que vai ser transcrito em HTML-->
        {!! Form::open(['route' => 'user.login', 'method' => 'post']) !!}

        <p>Acesse o sistema</p>

        <label>
            {!! Form::text('username', null, ['class' => 'input', 'placeholder' => 'Usuário']) !!}
        </label>

        <label>
            {!! Form::password('password', ['class' => 'input', 'placeholder' => 'Senha']) !!}
        </label>

        <span>
                @if(session('success'))
                {{ session('success')['messages'] }}
            @endif
            </span>
        <br>

        {!! Form::submit('Entrar') !!}

        {!! Form::close() !!}
    </section>
@endsection()
