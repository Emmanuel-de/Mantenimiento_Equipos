@extends('layouts.app')

@section('title', 'Editar Tipo de Incidencia')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Tipo de Incidencia</h1>

    <form action="{{ route('catalogo.tipos_incidencias.update', $tipo) }}" method="POST">
        @method('PUT')
        @include('catalogo.tipos_incidencias.form')
    </form>
@endsection
