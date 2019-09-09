<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.css">
    
    <title>Document</title>
</head>
<body>
    <div class="container">
            @include('menu')

    <h1>{{ $titulo }}</h1>
        
    @if ($diputados!=[])
    
        <table class="table table-sm table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Diputado(a)</th>
                <th scope="col">Partido</th>
                <th scope="col">Distrito</th>
                <th scope="col">Tipo de elección</th>
                <th scope="col">Tipo de cargo</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($diputados as $diputado)
                    <tr class="">
                        <th>{{ $diputado->nombreDiputado }}</th>
                        <td>{{ $diputado->nombrePartido }}</td>
                        <td>{{ $diputado->nombreDistrito }}</td>
                        <td>{{ $diputado->tipoDeEleccion }}</td>
                        <td>{{ $diputado->tipoDeCargo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h1>No hay legisladores para esta legislatura</h1>
        @endif
    </div>
</body>
</html>