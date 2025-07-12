<!-- resources/views/catalogo/tipos_mantenimiento/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Editar Tipo de Mantenimiento')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Tipo de Mantenimiento</h1>

    @if ($errors->any())
        <div class="bg-red-100 p
