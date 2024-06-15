@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('template-admin/css/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-admin/css/buttons.datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-admin/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fa fa-sitemap bg-c-blue"></i>
                    <div class="d-inline">
                        <h3>Listado de Endosos</h3>
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
                            <a href="{{ route('contracts.show', $item->contract_id) }}">Pólizas</a>
                            {{-- <a>Póliza Nº {{ $item->contract_id }}</a> --}}
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
                    <h5>Póliza: {{ $item->policy->description }} - N°: {{ $item->number_policy }}</h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-left">
                                        {{-- <h5>Listado Precios Referenciales del Ítem Nro {{ $item->item_number }}</h5> --}}
                                        {{-- <h5>Producto {{ $item->level5_catalog_code->description }}</h5> --}}
                                    </div>
                                    <div class="float-right">

                                    {{-- En caso de no tener precios referenciales relacionados--}}
                                    {{-- @if($item_award_histories->count() == 0)
                                        @if (Auth::user()->hasPermission(['admin.item_award_histories.create', 'contracts.item_award_histories.create']) || $item->contract->dependency_id == Auth::user()->dependency_id)
                                            <a href="{{ route('item_award_histories.create', $item->id) }}" class="btn btn-primary">Agregar Endoso</a>
                                        @endif
                                    @else
                                        @if (Auth::user()->hasPermission(['admin.item_award_histories.update', 'contracts.item_award_histories.update']) || $item->contract->dependency_id == Auth::user()->dependency_id)
                                            <a href="{{ route('item_award_histories.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                                        @endif
                                        @if (Auth::user()->hasPermission(['admin.item_award_histories.delete', 'contracts.item_award_histories.delete']) || $item->contract->dependency_id == Auth::user()->dependency_id)
                                            <button type="button" title="Borrar" class="btn btn-danger" onclick="deleteItemAwardHistories({{ $item->id }})">
                                                Borrar
                                            </button>
                                        @endif
                                    @endif --}}
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="item_award_histories" class="table table-striped table-bcontracted nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>N° de Póliza</th>
                                                    <th>Vigencia Desde</th>
                                                    <th>Vigencia Hasta</th>
                                                    <th>Monto</th>
                                                    <th>Comentarios</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @for ($i = 0; $i < count($item_award_histories); $i++)
                                                <tr>
                                                    <td>{{ ($i+1) }}</td>
                                                    <td>{{ $item_award_histories[$i]->number_policy }}</td>
                                                    <td>{{ $item_award_histories[$i]->itemFromDateFormat() }}</td>
                                                    <td>{{ $item_award_histories[$i]->itemtoDateFormat() }}</td>
                                                    <td>{{ $item_award_histories[$i]->amountFormat() }}</td>
                                                    <td>{{ $item_award_histories[$i]->comments }}</td>
                                                    <td>
                                                    {{-- @if (Auth::user()->hasPermission(['admin.items.update','contracts.items.update']) || $item->dependency_id == Auth::user()->dependency_id) --}}
                                                        <button type="button" title="Editar" class="btn btn-warning btn-icon" onclick="updateItem({{ $item_award_histories[$i]->id }})">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                    {{-- @endif --}}
                                                    {{-- @if (Auth::user()->hasPermission(['admin.items.delete','contracts.items.update']) || $item->dependency_id == Auth::user()->dependency_id) --}}
                                                        <button type="button" title="Borrar" class="btn btn-danger btn-icon" onclick="deleteItem({{$item_award_histories[$i]->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    {{-- @endif --}}
                                                    </td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="text-right">
                                            @if (Auth::user()->hasPermission(['contracts.contracts.create','admin.orders.create']))
                                                {{-- Si pedido está anulado no muestra agregar ítems --}}
                                                {{-- @if (in_array($contract->contract_state_id, [1,2])) --}}
                                                <a href="{{ route('item_award_histories.create', $item->id) }}" class="btn btn-primary">Agregar Endoso</a>
                                                {{-- @endif --}}
                                            @endif
                                        </div>
                                    </div>
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
<script src="{{ asset('template-admin/js/jquery.datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template-admin/js/datatables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template-admin/js/datatables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template-admin/js/datatables.responsive.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#item_award_histories').DataTable();

    updateItem = function(item){
        //llamar a Función JS que está en H:\Proyectos\sistedoc\public\js\guardar-tab.js
        // persistirTab();
        location.href = '/items/{{ $item->id }}/item_award_histories/edit/';
    }

    deleteItemAwardHistories = function(item_id){
      swal({
            title: "Atención",
            text: "Está seguro que desea eliminar los registros?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        },
        function(isConfirm){
          if(isConfirm){
            $.ajax({
              url : '/items/'+item_id+'/item_award_histories',
              method : 'POST',
              data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
              success: function(data){
                try{
                    response = (typeof data == "object") ? data : JSON.parse(data);
                    if(response.status == "success"){
                        location.href = "{{ route('contracts.show', $item->contract->id) }}";
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
        }
      );
    };

});
</script>
@endpush
