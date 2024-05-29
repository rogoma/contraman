@extends('layouts.app')

@push('styles')
<style type="text/css">
#template, #first_item_award_history {
    border: 1px solid #78949f;
    padding: 20px;
}
</style>
@endpush

@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fa fa-sitemap bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Agregar Endosos de Pólizas</h5>
                        {{-- Póliza {{ $item->number_policy }} --}}
                        <h5>Póliza: {{ $item->policy->description }} - N°: {{ $item->number_policy }}</h5>
                        {{-- <span>Agregar Endosos de Pólizas</span> --}}
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
                            <a href="{{ route('item_award_histories.index', $item->id) }}">Listado de Endosos de Pólizas</a>
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
                                    <h5>Agregar Endosos de Póliza</h5>
                                </div>
                                <div class="card-block">
                                    <form id="formCreate" method="POST">

                                        <div id="template" class="d-none m-b-25">
                                            <div class="m-b-10 row">
                                                <label class="col-sm-3 col-form-label">Acción</label>
                                                <div class="col-sm-9">
                                                    <select id="type">
                                                        <option value="pac">Endoso de Póliza</option>
                                                        {{-- <option value="budget_request">Solicitud de Presupuesto a Empresa</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row @error('number_policy') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">N° de Póliza</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="number_policy" name="number_policy" maxlength="300" value="{{ old('number_policy') }}" class="form-control">
                                                    @error('number_policy')
                                                        <div class="col-form-label">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                        <label class="col-form-label @error('item_from') has-danger @enderror">Vigencia Desde</label>
                                                        <div class="input-group @error('item_from') has-danger @enderror">
                                                            <input type="text" id="item_from" name="item_from" value="{{ old('item_from') }}" class="form-control text-align: left" autocomplete="off">
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
                                                            <input type="text" id="item_to" name="item_to" value="{{ old('item_to') }}" class="form-control" autocomplete="off">
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
                                                    <input type="text" id="amount" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') form-control-danger @enderror">
                                                    @error('amount')
                                                        <div class="col-form-label">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row @error('comments') has-danger @enderror">
                                                <label class="col-sm-2 col-form-label">Comentarios</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="comments" name="comments" maxlength="300" value="{{ old('comments') }}" class="form-control">
                                                    @error('comments')
                                                        <div class="col-form-label">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12 text-right">
                                                <button type="button" title="Borrar Fila" onclick="delRow(this);" class="btn btn-sm btn-danger">
                                                    <span class="f-20">-</span>
                                                </button>
                                            </div>
                                        </div>


                                        <div id="item_award_histories">
                                            <div id="first_item_award_history" class="m-b-25">

                                                <div class="form-group row @error('number_policy') has-danger @enderror">
                                                    <label class="col-sm-2 col-form-label">N° de Póliza</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="number_policy" name="number_policy" maxlength="300" value="{{ old('number_policy') }}" class="form-control">
                                                        @error('number_policy')
                                                            <div class="col-form-label">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                            <label class="col-form-label @error('item_from') has-danger @enderror">Vigencia Desde</label>
                                                            <div class="input-group @error('item_from') has-danger @enderror">
                                                                <input type="text" id="item_from" name="item_from" value="{{ old('item_from') }}" class="form-control text-align: left" autocomplete="off">
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
                                                                <input type="text" id="item_to" name="item_to" value="{{ old('item_to') }}" class="form-control" autocomplete="off">
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
                                                        <input type="text" id="amount" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') form-control-danger @enderror">
                                                        @error('amount')
                                                            <div class="col-form-label">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('comments') has-danger @enderror">
                                                    <label class="col-sm-2 col-form-label">Comentarios</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="comments" name="comments" maxlength="300" value="{{ old('comments') }}" class="form-control">
                                                        @error('comments')
                                                            <div class="col-form-label">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 text-right">
                                                    <button type="button" id="addRow" title="Agregar Nueva Fila" class="btn btn-sm btn-success">
                                                        <span class="f-18">+</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="error" class="col-sm-12 d-none">
                                            <div class="alert alert-danger">
                                                <span id="error_message"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary m-b-0">Guardar</button>
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

    //ACA VA EL CÓDIGO DE JSCRIPT DE CREATE DE ITEMS
    // Script para formatear el valor con separador de miles mientras se ingresa Monto
    document.getElementById('amount').addEventListener('input', function(event) {
    // Obtenemos el valor ingresado
    let monto = event.target.value.replace(/\./g, '');
    // Comprobamos si el valor es vacío
    if (monto === '') {
        event.target.value = '0';
        return;
    }
    // Convertimos a número y formateamos el valor con separador de miles
    monto = parseFloat(monto).toLocaleString('es-ES');

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


    // $('body').on('change', '#type', function() {
    //     if($(this).val() == "budget_request"){
    //         $(this).closest('.row').next().addClass('d-none'); // PAC
    //         $(this).closest('.row').next().next().removeClass('d-none'); // SOLICITUD EMPRESAS
    //         $(this).closest('.row').next().next().find('#budget_request_provider').select2();
    //     }else{
    //         $(this).closest('.row').next().removeClass('d-none'); // PAC
    //         $(this).closest('.row').next().next().addClass('d-none'); // SOLICITUD EMPRESAS
    //     }
    // });

    $('#addRow').click(function(){
        // clonamos el template creado
        new_row = $('#template').clone();
        new_row.removeClass('d-none');
        // agregamos los name para el envio del formulario
        new_row.find('#type').attr('name', 'type[]');
        new_row.find('#type').attr('class', 'form-control type');

        new_row.find('#number_policy').attr('name', 'number_policy[]');
        new_row.find('#number_policy').attr('class', 'form-control number_policy');

        new_row.find('#item_from').attr('name', 'item_from[]');
        new_row.find('#item_from').attr('class', 'form-control item_from');

        new_row.find('#item_to').attr('name', 'item_to[]');
        new_row.find('#item_to').attr('class', 'form-control item_to');

        new_row.find('#amount').attr('name', 'amount[]');
        new_row.find('#amount').attr('class', 'form-control amount autonumber');
        new_row.find('#amount').attr('data-a-sep', '.');
        new_row.find('#amount').attr('data-a-dec', ',');
        new_row.find('#amount').autoNumeric('init');

        new_row.find('#comments').attr('name', 'comments[]');
        new_row.find('#comments').attr('class', 'form-control comments');

        // agregamos el template creado al html
        $('#item_award_histories').append(new_row);
    });
    delRow = function(element){
        element.closest('#template').remove();
    }

    $('#formCreate').submit(function(e){
        e.preventDefault();

        // VALIDACIONES
        error = false;
        // dncp_pac_ids = document.getElementsByClassName('dncp_pac_id');
        // budget_request_providers = document.getElementsByClassName('budget_request_provider');
        amounts = document.getElementsByClassName('amount');

        $('.type').each(function(index,element){
            // chequeamos que el pac sea numerico y obligatorio
            // if(element.value == 'pac'){
            //     dncp_pac_id = dncp_pac_ids[index].value.replace(/\./g, '');
            //     if(isNaN(dncp_pac_id) || dncp_pac_id == ""){
            //         $('#error_message').html('El campo PAC ID del precio referencial '+(index+1)+' debe ser numérico y no estar vacío.');
            //         $('#error').removeClass('d-none');
            //         error = true;
            //         return false;
            //     }
            // }else{
            //     if(budget_request_providers[index].value == ""){
            //         $('#error_message').html('El campo Empresas solicitadas presupuesto del precio referencial '+(index+1)+' no debe estar vacío.');
            //         $('#error').removeClass('d-none');
            //         error = true;
            //         return false;
            //     }
            // }

            amount = amounts[index].value.replace('Gs. ', '').replace(/\./g, '');
            if(isNaN(amount) || amount == ""){
                $('#error_message').html('El campo Monto'+(index+1)+' debe ser numérico y no estar vacío.');
                $('#error').removeClass('d-none');
                error = true;
                return false;
            }
        });

        // SE PASARON TODAS LAS VALIDACIONES, enviamos los datos
        if(!error){
            $.ajax({
                url: "{{ route('item_award_histories.store', $item->id) }}",
                method: 'POST',
                data: $('#formCreate').serialize()+'&_token={{ csrf_token() }}',
                success: function(data){
                    try{
                        response = (typeof data == "object") ? data : JSON.parse(data);
                        if(response.status == "success"){
                            location.href = "{{ route('item_award_histories.index', $item->id) }}";
                        }else{
                            swal("Error!", response.message, "error");
                        }
                    }catch(error){
                        swal("Error!", "Ocurrió un error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
                        console.log(error);
                    }
                },
                error: function(error){
                    swal("Error!", "Ocurrió un error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
                    console.log(error);
                }
            });
        }
    });

});
</script>
@endpush
