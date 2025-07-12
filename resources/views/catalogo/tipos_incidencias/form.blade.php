@csrf
<div class="mb-4">
    <label for="nombre" class="block mb-2 font-semibold">Nombre del tipo de incidencia</label>
    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $tipo->nombre ?? '') }}"
           class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

<div class="flex justify-end">
    <a href="{{ route('catalogo.tipos_incidencias.index') }}" class="px-4 py-2 bg-gray-300 rounded mr-2">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        {{ isset($tipo) ? 'Actualizar' : 'Guardar' }}
    </button>
</div>
