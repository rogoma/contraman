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
                        <h5>Listado de Precios Referenciales</h5>
                        <span>Agregar Precios Referenciales</span>
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
                            <a href="{{ route('item_award_histories.index', $item->id) }}">Listado de Precios Referenciales</a>
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
                                    <h5>Agregar Precios Referenciales</h5>
                                </div>
                                <div class="card-block">
                                    <form id="formCreate" method="POST">

                                        <div id="template" class="d-none m-b-25">
                                            <div class="m-b-10 row">
                                                <label class="col-sm-3 col-form-label">Fuente Precio Referencial</label>
                                                <div class="col-sm-9">
                                                    <select id="type">
                                                        <option value="pac">Histórico de Adjudicaciones del SICP</option>
                                                        <option value="budget_request">Solicitud de Presupuesto a Empresa</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="m-b-10 row">
                                                <label class="col-sm-3 col-form-label">PAC ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="dncp_pac_id">
                                                </div>
                                            </div>

                                            <div class="m-b-10 row d-none">
                                                <label class="col-sm-3 col-form-label">Empresas solicitadas presupuesto</label>
                                                <div class="col-sm-9">
                                                    <select id="budget_request_provider">
                                                        <option value="">--- Seleccionar Empresa ---</option>
                                                        @foreach ($budget_request_providers as $budget_request_provider)
                                                            <option value="{{ $budget_request_provider->id }}">{{ $budget_request_provider->provider->description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="m-b-10 row">
                                                <label class="col-sm-3 col-form-label">Monto</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="amount">
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
                                                <div class="m-b-10 row">
                                                    <label class="col-sm-3 col-form-label">Fuente Precio Referencial</label>
                                                    <div class="col-sm-9">
                                                        <select id="type" class="form-control type" name="type[]">
                                                            <option value="pac">Histórico de Adjudicaciones del SICP</option>
                                                            <option value="budget_request">Solicitud de Presupuesto a Empresa</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="m-b-10 row">
                                                    <label class="col-sm-3 col-form-label">PAC ID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="dncp_pac_id" name="dncp_pac_id[]" class="form-control dncp_pac_id autonumber" data-a-sep="." data-a-dec=",">
                                                    </div>
                                                </div>

                                                <div class="m-b-10 d-none row">
                                                    <label class="col-sm-3 col-form-label">Empresas solicitadas presupuesto</label>
                                                    <div class="col-sm-9">
                                                        <select id="budget_request_provider" name="budget_request_provider[]" class="form-control budget_request_provider">
                                                            <option value="">--- Seleccionar Empresa ---</option>
                                                            @foreach ($budget_request_providers as $budget_request_provider)
                                                                <option value="{{ $budget_request_provider->id }}" >{{ $budget_request_provider->provider->description }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="m-b-10 row">
                                                    <label class="col-sm-3 col-form-label">Monto</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="amount" name="amount[]" class="form-control amount autonumber" data-a-sign="Gs. " data-a-sep="." data-a-dec=",">
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

    $('body').on('change', '#type', function() {
        if($(this).val() == "budget_request"){
            $(this).closest('.row').next().addClass('d-none'); // PAC
            $(this).closest('.row').next().next().removeClass('d-none'); // SOLICITUD EMPRESAS
            $(this).closest('.row').next().next().find('#budget_request_provider').select2();
        }else{
            $(this).closest('.row').next().removeClass('d-none'); // PAC
            $(this).closest('.row').next().next().addClass('d-none'); // SOLICITUD EMPRESAS
        }
    });

    $('#addRow').click(function(){
        // clonamos el template creado
        new_row = $('#template').clone();
        new_row.removeClass('d-none');
        // agregamos los name para el envio del formulario
        new_row.find('#type').attr('name', 'type[]');
        new_row.find('#type').attr('class', 'form-control type');
        new_row.find('#dncp_pac_id').attr('name', 'dncp_pac_id[]');
        new_row.find('#dncp_pac_id').attr('class', 'form-control dncp_pac_id autonumber');
        new_row.find('#dncp_pac_id').attr('data-a-sep', '.');
        new_row.find('#dncp_pac_id').attr('data-a-dec', ',');
        new_row.find('#dncp_pac_id').autoNumeric('init');
        new_row.find('#budget_request_provider').attr('name', 'budget_request_provider[]');
        new_row.find('#budget_request_provider').attr('class', 'form-control budget_request_provider');
        new_row.find('#amount').attr('name', 'amount[]');
        new_row.find('#amount').attr('class', 'form-control amount autonumber');
        new_row.find('#amount').attr('data-a-sign', 'Gs. ');
        new_row.find('#amount').attr('data-a-sep', '.');
        new_row.find('#amount').attr('data-a-dec', ',');
        new_row.find('#amount').autoNumeric('init');
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
        dncp_pac_ids = document.getElementsByClassName('dncp_pac_id');
        budget_request_providers = document.getElementsByClassName('budget_request_provider');
        amounts = document.getElementsByClassName('amount');
        $('.type').each(function(index,element){
            // chequeamos que el pac sea numerico y obligatorio
            if(element.value == 'pac'){
                dncp_pac_id = dncp_pac_ids[index].value.replace(/\./g, '');
                if(isNaN(dncp_pac_id) || dncp_pac_id == ""){
                    $('#error_message').html('El campo PAC ID del precio referencial '+(index+1)+' debe ser numérico y no estar vacío.');
                    $('#error').removeClass('d-none');
                    error = true;
                    return false;
                }
            }else{
                if(budget_request_providers[index].value == ""){
                    $('#error_message').html('El campo Empresas solicitadas presupuesto del precio referencial '+(index+1)+' no debe estar vacío.');
                    $('#error').removeClass('d-none');
                    error = true;
                    return false;
                }
            }

            amount = amounts[index].value.replace('Gs. ', '').replace(/\./g, '');
            if(isNaN(amount) || amount == ""){
                $('#error_message').html('El campo Monto del precio referencial '+(index+1)+' debe ser numérico y no estar vacío.');
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