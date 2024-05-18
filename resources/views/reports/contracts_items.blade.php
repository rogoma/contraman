<!DOCTYPE html>
<html>
<head>
    <title>Llamado con Póliza</title>
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
        font-size:10px;
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
    <h2>INFORME DE VERIFICACIÓN DE PÓLIZAS Y GARANTÍAS</h2>
    <br>



    {{-- <h2>LLAMADOS</h2> --}}
        <table>
            {{-- <tr>|| |
                <th>#</th>
                <th>Llamado N°</th>
                <th>IDDNCP</th>
                <th>N°Contrato</th>
                <th>Año adjud.</th>
                <th>Fecha Firma Contr.</th>
                <th>Contratista</th>
                <th>Estado</th>
                <th>Modalidad</th>
                <th>Monto total LLAMADO</th>
                <th>Comentarios</th>
            </tr> --}}

            {{-- <td> Llamado N°: {{ $contracts->iddncp }} N°Contrato: {{ $contracts->number_year }}</td></td> --}}

            {{-- <td>N°Contrato: {{ $contracts->number_year }}</td></td> --}}
            <td> {{ $contracts[$i]->number_year }} 

            {{-- <td> Descripción Obra: {{ $contracts->contrato }} 
            <td> Contratista: {{ $contracts->contratista }}</td>
            <td> Dependencia Responsable: {{ $contracts->dependencia }}</td> --}}

            <tr>                
                <th>Tipo de Póliza</th>                
                <th>N° Póliza</th>
                <th>Vencimiento</th>
                <th>Comentarios</th>
            </tr>

            @for ($i = 0; $i < count($contracts); $i++)
            <tr>
                <td> {{ $contracts[$i]->polizas }}</td>                
                <td> {{ $contracts[$i]->number_policy }}</td>
                <td> {{ $contracts[$i]->year_adj }}</td>                
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->item_to )) }}</td>
                <td> {{ $contracts[$i]->comments}}</td>
            </tr>
            @endfor
            {{-- @endforeach --}}
        </table>
    </div>
</body>
</html>
