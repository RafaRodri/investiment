@extends('templates.master')


@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    @include('moviment.list', ['product_list' => $product_list])

@endsection()
