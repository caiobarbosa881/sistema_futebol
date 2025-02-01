@extends('partials.app')

@section('title', 'Algum Erro Ocorreu')

@section('content')
    <h1>Nenhuma informação desse Time Foi Encontrada, Tente Novamente aqui: </h1>
    <a href="{{ route('times') }}">Clique aqui para escolher um novo time</a>
@endsection
