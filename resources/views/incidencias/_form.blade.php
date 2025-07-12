@csrf

<div class="mb-4">
    <label for="equipo_id" class="block text-gray-700">Equipo</label>
    <select name="equipo_id" id="equipo_id" class="border rounded w-full">
        @foreach ($equipos as $equipo)
            <option value="{{ $equipo->id }}" 
                {{ (old('equipo_id', $incidencia->equipo_id ?? '') == $equipo->id) ? 'selected' : '' }}>
                {{ $equipo->nombre ?? $equipo->id }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="fecha" class="block text-gray-700">Fecha</label>
    <input type="date" name="fecha" id="fecha" 
        value="{{ old('fecha', $incidencia->fecha ?? '') }}" class="border rounded w-full">
</div>

<!-- Añade los demás campos de forma similar -->

