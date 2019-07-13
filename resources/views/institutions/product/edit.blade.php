@extends('templates.master')

@section('content-view')

    <header>
        <h1>{{ $product->institution->name }}</h1>
    </header>

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::model($product, ['route' => ['institution.product.update', $product->institution->id, $product->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('institutions.product.form-fields', ['submit_name' => 'Atualizar'])
    {!! Form::close() !!}

    @include('institutions.product.list', ['institution' => $product->institution])

@endsection
