<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Pólizas en Llamados</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
</head>
<style type="text/css">
    table{
        font-family: arial,sans-serif;
        border-collapse:collapse;
        width:100%;
        font-size:8px;
    }
    td, th{
        border:1px solid #dddddd;
        text-align: left;
        padding:4px;
        font-size:8px;
    }
    thead tr{
        background-color:#dddddd;
        padding:2px;
        font-size:8px;
    }

    h2{
        text-align: center;
        font-size:12px;
        margin-bottom:5px;
    }
    h3{
        text-align: left;
        font-size:12px;
        margin-bottom:15px;
    }
    body{
        /* background:#f2f2f2; */
    }
    .section{
        margin-top:30px;
        padding:50px;
        background:#fff;
        font-size:8px;
    }
    .pdf-btn{
        margin-top:30px;
    }
    .columna1 { width: 1%; text-align: center;}
    .columna2 { width: 25%; text-align: left;}
    .columna3 { width: 7%; text-align: left;}
    .columna4 { width: 16%; text-align: left;}
    .columna5 { width: 2%; text-align: center;}
    .columna6 { width: 4%; text-align: center;}
    .columna7 { width: 4%; text-align: center;}
    .columna8 { width: 4%; text-align: center;}
    .columna9 { width: 5%; text-align: left;}
    .columna10 { width: 9%; text-align: center;}
    .columna11 { width: 2%; text-align: center;}

    p.centrado {
        text-align: center;
}

</style>
<body>
<p class="centrado"> <img src="img/logoVI.png"> </p>

{{-- SE PREGUNTA POR EL NOMBRE DEL METODO DE ACUERDO A ESO SE ESCOGE EL TITULO DEL REPORTE --}}
{{-- @if ($nombreMetodo == "App\Http\Controllers\Report\ReportsController::generarContracts5") --}}
    <h2 style="color:#ff0000">ALERTA DE DETALLES DE PÓLIZAS</h2>
{{-- @endif --}}

    {{-- <h2>LLAMADOS</h2> --}}
        <table>
            <tr>
                <th>#</th>
                <th>Dependencia</th>
                <th>Llamado</th>
                <th>IDDNCP</th>
                <th>N°Contrato</th>
                <th>Contratista</th>
                <th>Tipo Contrato</th>
                <th>Monto total LLAMADO</th>
                <th>Fecha Alerta</th>
                <th>Fecha Vcto.</th>
                <th>Tipo Póliza</th>
                <th>N° Póliza</th>
                <th>Comentarios</th>
                {{-- <th>Modalidad</th> --}}
            </tr>

            @for ($i = 0; $i < count($contracts); $i++)
            <tr>
                <td>{{ ($i+1) }}</td>
                <td> {{ $contracts[$i]->dependencia }}</td>
                <td> {{ $contracts[$i]->llamado }}</td>
                <td> {{ number_format($contracts[$i]->iddncp,'0', ',','.') }} </td>
                <td> {{ $contracts[$i]->number_year }}</td>
                <td> {{ $contracts[$i]->contratista}}</td>
                <td> {{ $contracts[$i]->tipo_contrato}}</td>
                <td> Gs.{{ number_format($contracts[$i]->total_amount,'0', ',','.') }} </td>

                @if ($contracts[$i]->fecha_tope_advance <= today())
                    <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_advance)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_advance )) }}</td>
                @else
                    <td>{{ is_null($contracts[$i]->fecha_tope_advance)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_advance )) }}</td>
                @endif

                <td>{{ is_null($contracts[$i]->vcto_adv)? "-" : date('d/m/Y', strtotime($contracts[$i]->vcto_adv )) }}</td>
                <td> {{ $contracts[$i]->polizas}}</td>
                <td> {{ $contracts[$i]->number_policy}}</td>
                <td> {{ $contracts[$i]->comentarios}}</td>
            </tr>
            @endfor
        </table>
    </div>
</body>
</html>
