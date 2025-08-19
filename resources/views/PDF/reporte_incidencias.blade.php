<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Incidencias</title>
    <style>
        /* Estilos básicos para tu PDF, puedes personalizarlos */
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Incidencias</h1>
    <p>Fecha de generación: {{ date('d/m/Y') }}</p>

    <h2>Incidencias</h2>
    @if($incidencias->isEmpty())
        <p>No hay incidencias para mostrar.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Equipo</th>
                    <th>Modelo</th>
                    <th>Tipo de Equipo</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidencias as $incidencia)
                <tr>
                    <td>{{ $incidencia->id }}</td>
                    <td>{{ $incidencia->departamento_id }}</td> {{-- O el nombre del departamento si lo cargas --}}
                    <td>{{ $incidencia->responsable }}</td>
                    <td>{{ $incidencia->equipo }}</td>
                    <td>{{ $incidencia->marca }}</td>
                    <td>{{ $incidencia->modelo }}</td>
                    <td>{{ $incidencia->tipo_equipo }}</td>
                    <td>{{ $incidencia->estado }}</td>
                    <td>{{ \Carbon\Carbon::parse($incidencia->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Mantenimientos</h2>
    @if($mantenimientos->isEmpty())
        <p>No hay mantenimientos para mostrar.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Tipo de Equipo</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mantenimientos as $mantenimiento)
                <tr>
                    <td>{{ $mantenimiento->id }}</td>
                    <td>{{ $mantenimiento->departamento_id }}</td>
                    <td>{{ $mantenimiento->responsable }}</td>
                    <td>{{ $mantenimiento->equipo }}</td>
                    <td>{{ $mantenimiento->marca }}</td>
                    <td>{{ $mantenimiento->modelo }}</td>
                    <td>{{ $mantenimiento->tipo_equipo }}</td>
                    <td>{{ $mantenimiento->estado }}</td>
                    <td>{{ \Carbon\Carbon::parse($mantenimiento->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>