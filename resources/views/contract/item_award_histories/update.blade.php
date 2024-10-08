@extends('layouts.app')

@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fa fa-sitemap bg-c-blue"></i>
                    <div class="d-inline">
                        <h3>Endosos</h3>
                        <span>Modificar Endoso</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('items.item_award_histories.index', $item->id) }}">Endosos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Modificar Endoso de la Póliza {{ $itemA->number_year }}</h5>
                                    <br><br>
                                    <label id="fecha_actual" name="fecha_actual"  style="font-size: 20px;color: #FF0000;float: left;" for="fecha_actual">{{ Carbon\Carbon::now()->format('d/m/Y') }}</label>                                    
                                </div>
                                <div class="card-block">
                                        <form method="POST" action="{{ route('items.item_award_histories.update', [$item->id, $itemA->id]) }}" enctype="multipart/form-data">                                            
                                        @csrf
                                        @method('PUT')

                                        <div class="container">
                                            <h3 style="text-align: center;">Modificar Endoso</h3>
                                            <br>
                                            <div class="form-group row @error('item_award_type_id') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">Tipo de Endoso</label>
                                                    <div class="col-sm-10">
                                                        <select id="item_award_type_id" name="item_award_type_id" class="form-control">
                                                            <option value="">Seleccionar Tipo de Endoso</option>
                                                            @foreach ($item_award_types as $item_award_type)
                                                                <option value="{{ $item_award_type->id }}" @if ($item_award_type->id == old('item_award_type_id', $itemA->item_award_type_id            )) selected @endif>{{ $item_award_type->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('item_award_type_id')
                                                            <div class="col-form-label">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                            </div>

                                            <div class="form-group row @error('number_policy') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">N° de Endoso</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="number_policy" name="number_policy" maxlength="300" value="{{ old('number_policy',$itemA->number_policy) }}" class="form-control">
                                                    @error('number_policy')
                                                        <div class="col-form-label">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                        <label class="col-form-label @error('item_from') has-danger @enderror">Vigencia Desde</label>
                                                        <div class="input-group @error('item_from') has-danger @enderror">
                                                            <input type="text" id="item_from" name="item_from" value="{{ old('item_from',date('d/m/Y', strtotime($itemA->item_from))) }}" class="form-control text-align: left" autocomplete="off">
                                                            <span class="input-group-append" id="basic-addon">
                                                                <label class="input-group-text" onclick="show('item_from');"><i class="fa fa-calendar"></i></label>
                                                            </span>
                                                        </div>
                                                        @error('item_from')
                                                        <div class="has-danger">
                                                            <div class="col-form-label">{{ $message }}</div>
                                                        </div>
                                                        @enderror
                                                </div>
                                                <div class="col-md-3">
                                                        <label class="col-form-label @error('item_to') has-danger @enderror">Vigencia Hasta</label>
                                                        <div class="input-group @error('item_to') has-danger @enderror">
                                                            <input type="text" id="item_to" name="item_to" value="{{ old('item_to',date('d/m/Y', strtotime($itemA->item_to))) }}" class="form-control text-align: left" autocomplete="off">
                                                            <span class="input-group-append" id="basic-addon">
                                                                <label class="input-group-text" onclick="show('item_to');"><i class="fa fa-calendar"></i></label>
                                                            </span>
                                                        </div>
                                                        @error('item_to')
                                                        <div class="has-danger">
                                                            <div class="col-form-label">{{ $message }}</div>
                                                        </div>
                                                        @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group @error('control_1') has-danger @enderror">
                                                        <label class="col-form-label">Días Vigencia</label>
                                                        <input type="text" id="control_1" readonly name="control_1" value="{{ old('control_1') }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group @error('control_a') has-danger @enderror">
                                                        <label class="col-form-label">Días para Vencer</label>
                                                        <input type="text" id="control_a" readonly name="control_a" value="{{ old('control_a') }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row @error('amount') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">Monto</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="amount" name="amount" value="{{ old('amount', number_format($itemA->amount, 0, ',', '.')) }}" class="form-control @error('amount') form-control-danger @enderror" maxlength="23">
                                                    @error('amount')
                                                        <div class="col-form-label">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row @error('comments') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">Comentarios</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="comments" name="comments" maxlength="300" value="{{ old('comments',$itemA->comments) }}" class="form-control">
                                                    @error('comments')
                                                        <div class="col-form-label">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row @error('filename') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">Archivo:</label>
                                                <div class="col-sm-10">
                                                    <label id="filename" name="filename">
                                                        <a href="{{ asset('storage/files/'. old('file', $itemA->file)) }}" target="_blank">
                                                            <i class="fa fa-file-pdf-o" style="font-size:24px;color:red" value="{{ old('filename',$itemA->file) }}"></i>
                                                            {{ old('filename', $itemA->file) }}
                                                        </a>
                                                    </label>
                                                    <!-- Para poder ver el valor del label en el controlador -->
                                                    <input type="hidden" name="filename" value="{{ old('filename', $itemA->file) }}">
                                                </div>
                                            </div>

                                            <div class="form-group @error('file') has-danger @enderror">
                                                <label class="col-form-label">Reemplazar Archivo <small>(Archivos permitidos: WORD, PDF)</small></label>
                                                <input id="file" type="file" class="form-control" name="file">
                                                @error('file')
                                                    <div class="col-form-label">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <br>
                                            <div class="form-group text-center">
                                                <button id="guardar" type="submit" class="btn btn-primary">Modificar Endoso</button>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

    // ***** CALCULA DIAS VIGENCIA Y DIAS PARA VENCER DE LA PÓLIZA ****
    restaFechas = function(f1,f2)
            {
                var aFecha1 = f1.split('/');
                var aFecha2 = f2.split('/');
                var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
                var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
                var dif = fFecha2 - fFecha1;
                var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
                return dias;
            }

            ///calcula dias que faltan para vencer
            restaFechas2 = function(f2,f3)
            {
                var aFecha1 = f3.split('/');
                var aFecha2 = f2.split('/');
                var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
                var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
                var dif = fFecha2 - fFecha1;
                var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
                return dias;
            }

            var f1 = $('#item_from').val();//fecha dtpicker inicio
            var f2=  $('#item_to').val(); //fecha dtpicker final
            var f3= $('#fecha_actual').text();//fecha actual
            $('#control_1').val(restaFechas(f1,f2));//resultado fecha vigencia
            $('#control_a').val(restaFechas2(f2,f3));//resultado fecha días para vencer
    //*******************************

    $('#policy_id').select2();
    $('#item_award_type_id').select2();

    // Script para formatear el valor con separador de miles mientras se ingresa Monto
    document.getElementById('amount').addEventListener('input', function(event) {
    // Obtenemos el valor ingresado
    let monto = event.target.value.replace(/\./g, '');
    // Comprobamos si el valor es vacío
    if (monto === '') {
        event.target.value = '0';
        return;
    }

    // Convertimos a número
    monto = parseFloat(monto);

    // Verificamos si el monto es un número válido y no NaN
    if (isNaN(monto) || monto < 0) {
        event.target.value = '0';
        return;
    }

    // Formateamos el valor con separador de miles
    monto = monto.toLocaleString('es-ES');

    // Actualizamos el valor en el input text
    event.target.value = monto;
    });


    $('#item_from').datepicker({
        language: 'es',
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    $('#item_to').datepicker({
        language: 'es',
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    //VALIDACIÓN DE FECHAS DE ANTICIPOS
    $('#item_from').on('changeDate', function() {
        var fechaInicio = $(this).datepicker('getDate').getTime();
        var fechaFin = $('#item_to').datepicker('getDate').getTime();

        if (fechaInicio === fechaFin){
            alert('La fecha final debe ser mayor a fecha de inicio');
            $('#item_to').datepicker('date', null); // Limpiar el datapicker
            $('#item_to').val('');
            $('#control_1').val('');
            $('#control_a').val('');
            return;
        }

        if (fechaFin == null){

        }else{
            if (fechaInicio > fechaFin) {
                alert('La fecha de inicio no puede ser mayor a la fecha final.');
                $('#item_to').datepicker('date', null); // Limpiar el datapicker
                $('#item_to').val('');
                $('#control_1').val('');
                $('#control_a').val('');
            }else{
                $('#item_to').datepicker('date', null); // Limpiar el datapicker
                $('#item_to').val('');
                $('#control_1').val('');
                $('#control_a').val('');

                //controla días para vigencia
                restaFechas = function(f1,f2)
                {
                    var aFecha1 = f1.split('/');
                    var aFecha2 = f2.split('/');
                    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
                    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
                    var dif = fFecha2 - fFecha1;
                    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
                    return dias;
                }

                $('#control_1').val(restaFechas(f1,f2));
            }
        }
    });

    $('#item_to').on('changeDate', function() {
        var fechaInicio = $('#item_from').datepicker('getDate').getTime();
        var fechaFin = $(this).datepicker('getDate').getTime();

        if (fechaInicio === fechaFin) {
            alert('La fecha final debe ser mayor a fecha de inicio');
            $('#item_to').datepicker('date', null); // Limpiar el datapicker
            $('#item_to').val('');
            $('#control_1').val('');
            $('#control_a').val('');
            return;
        }

        if (fechaInicio > fechaFin) {
            alert('La fecha de inicio no puede ser mayor a la fecha final.');
            $('#item_to').datepicker('date', null); // Limpiar el datapicker
            $('#item_to').val('');
            $('#control_1').val('');
            $('#control_a').val('');
        }else{
            ///calcula dias de vigencia
            restaFechas = function(f1,f2)
            {
                var aFecha1 = f1.split('/');
                var aFecha2 = f2.split('/');
                var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
                var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
                var dif = fFecha2 - fFecha1;
                var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
                return dias;
            }

            ///calcula dias que faltan para vencer
            restaFechas2 = function(f2,f3)
            {
                var aFecha1 = f3.split('/');
                var aFecha2 = f2.split('/');
                var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
                var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
                var dif = fFecha2 - fFecha1;
                var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
                return dias;
            }

            var f1 = $('#item_from').val();//fecha dtpicker inicio
            var f2=  $('#item_to').val(); //fecha dtpicker final
            var f3= $('#fecha_actual').text();//fecha actual
            $('#control_1').val(restaFechas(f1,f2));//resultado fecha vigencia
            $('#control_a').val(restaFechas2(f2,f3));//resultado fecha días para vencer
        }
    });

    $('#item_to').datepicker('date', null); // Limpiar el datapicker

    $('#file').bind('change', function() {
        max_upload_size = {{ $post_max_size }};
        if(this.files[0].size > max_upload_size){
            $('#guardar').attr("disabled", "disabled");
            file_size = Math.ceil((this.files[0].size/1024)/1024);
            max_allowed = Math.ceil((max_upload_size/1024)/1024);
            swal("Error!", "El tamaño del archivo seleccionado ("+file_size+" Mb) supera el tamaño maximo de carga permitido ("+max_allowed+" Mb).", "error");
        }else{
            $('#guardar').removeAttr("disabled");
        }
    });
});
</script>
@endpush
