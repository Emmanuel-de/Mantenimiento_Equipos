@extends('layouts.app')

@section('title', 'Crear Tipo de Incidencia')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Nuevo Tipo de Incidencia</h1>

    <form action="{{ route('catalogo.tipos_incidencias.store') }}" method="POST">
        @include('catalogo.tipos_incidencias.form')
    </form>
@endsection
