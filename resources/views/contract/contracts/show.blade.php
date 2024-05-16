@extends('layouts.app')

@push('styles')
<style type="text/css">
.table td, .table th {
    padding: 0.2rem 0.5rem;
    font-size: 14px
}
.tab-content.card-block {
    padding: 1.25rem 0.5rem;
}
}
.columna1 { width: 1%; text-align: center;}
.columna2 { width: 10%; text-align: left;}
.columna3 { width: 9%; text-align: left;}
.columna4 { width: 16%; text-align: left;}
.columna5 { width: 2%; text-align: center;}
.columna6 { width: 4%; text-align: center;}
.columna7 { width: 4%; text-align: center;}
.columna8 { width: 3%; text-align: center;}
.columna9 { width: 3%; text-align: left;}
.columna10 { width: 3%; text-align: center;}
.columna11 { width: 9%; text-align: left;}
.columna12 { width: 10%; text-align: left;}

p.centrado {

}
</style>
@endpush

@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fa fa-list bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Visualizar Llamado</h5>
                        <span>Llamado Nº {{ $contract->number_year }}</span>
                        <br><br>
                        {{-- <h6>Estado Actual: {{ $contract->contractstate->id." - ".$contract->contractstate->description }}</h6> --}}
                        <h5><p style="font-size: 17px; font-weight: bold; color:#FF0000">Estado Actual: {{ $contract->contractState->id." - ".$contract->contractState->description }}</p></h5>
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
                            <a href="{{ route('contracts.index') }}">Llamados</a>
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
                                    <div class="row">
                                        <div class="col-sm-10 text-left">
                                            <h5>Llamado: {{ $contract->description." - ".$contract->modality->description." N° ".$contract->number_year." - ".$contract->provider->description }}
                                        </div>
                                            <div class="col-sm-2">
                                            @if (in_array($contract->contract_state_id, [1,2]))
                                                <button class="btn btn-primary dropdown-toggle waves-effect" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Acciones</button>
                                            @endif

                                            <div class="dropdown-menu" aria-labelledby="acciones" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                {{-- Verificamos permisos de edición del usuario --}}
                                                @if ((Auth::user()->hasPermission(['contracts.contracts.update']) && $contract->contract_state_id >= 1) || Auth::user()->hasPermission(['admin.contracts.update']))
                                                    <a style="font-size: 14px; font-weight: bold; color:blue;background-color:lightblue;" class="dropdown-item waves-effect f-w-600" href="{{ route('contracts.edit', $contract->id)}}">Editar Llamado</a>
                                                @endif

                                                @if ((Auth::user()->hasPermission(['admin.contracts.delete'])) || Auth::user()->hasPermission(['contracts.contracts.delete']))
                                                        {{-- <a style="font-size: 14px; font-weight: bold; color:red;background-color:lightblue;" class="dropdown-item waves-effect f-w-600" onclick="deleteContract({{ $contract->id }})">Eliminar Llamado</a> --}}
                                                        {{-- <a style="font-size: 14px; font-weight: bold; color:red;background-color:lightblue;" class="dropdown-item waves-effect f-w-600" onclick="deleteContract({{ $contract->id }})">Eliminar Llamado</a> --}}
                                                        <a href="#" style="font-size: 14px; font-weight: bold; color:red;background-color:lightblue;" class="dropdown-item waves-effect f-w-600" onclick="deleteContract('{{ $contract->id }}')">Eliminar Llamado</a>


                                                        {{-- <button type="button" title="Borrar" class="btn btn-danger btn-icon" onclick="deleteItem({{ $contract->id }})"><i class="fa fa-trash"></i></button>                                                         --}}
                                                @endif

                                                {{-- Verificamos permisos de derivación del pedido y que el pedido tenga estado PROCESADO PEDIDO --}}
                                                {{-- @if (Auth::user()->hasPermission(['derive_contracts.contracts.derive']) && $contract->contract_state_id == 4)
                                                <a class="dropdown-item waves-effect f-w-600" href="{{ route('derive_contracts.create', $contract->id) }}">Procesar Pedido en DGAF</a>
                                                @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-block">
                                    <ul class="nav nav-tabs md-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><i class="fa fa-tasks"></i> Datos del Llamado</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><i class="fa fa-list"></i> Pólizas</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab4" role="tab"><i class="fa fa-file-pdf-o"></i> Reportes (VER FORMATO)</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab5" role="tab"><i class="fa fa-folder-open-o"></i> Archivos Pólizas (Ver en el Controller paramostrar por separado)</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab6" role="tab"><i class="fa fa-file-archive-o"></i> Archivos Contratos</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>

                                    <div class="tab-content card-block">
                                        <div class="tab-pane active" id="tab1" role="tabpanel">
                                            <h5 class="text-center">Datos del LLAMADO</h5>
                                            <table class="table table-striped table-bcontracted">
                                                <tbody>
                                                    <tr>
                                                        <td><label class="col-form-label f-w-600" >Nombre del Llamado:</label></td>
                                                        <td><label class="col-form-label f-w-600" >Tipo Llamado:</label></td>
                                                        <td><label class="col-form-label f-w-600">IDDNCP:</label></td>
                                                        <td><label class="col-form-label f-w-600">Link DNCP:</label></td>
                                                        <td><label class="col-form-label f-w-600">N° Contrato/Año:</label></td>
                                                        <td><label class="col-form-label f-w-600">AÑO:</label></td>
                                                        <td><label class="col-form-label f-w-600">Fecha firma contrato:</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $contract->description }}</td>
                                                        <td>{{ $contract->modality->description }}</td>
                                                        <td> {{ number_format($contract->iddncp,'0', ',','.') }} </td>
                                                        <td style="color:blue">{{ $contract->linkdncp }}</td>
                                                        <td>{{ $contract->number_year }}</td>
                                                        <td> {{ number_format($contract->year_adj,'0', ',','.') }} </td>
                                                        <td>{{ $contract->signDateFormat() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-form-label f-w-600">Contratista:</label></td>
                                                        <td><label class="col-form-label f-w-600">Estado:</label></td>
                                                        <td><label class="col-form-label f-w-600">Modalidad:</label></td>
                                                        <td><label class="col-form-label f-w-600">Organismo Finaciador:</label></td>
                                                        <td><label class="col-form-label f-w-600">Tipo de Contrato:</label></td>
                                                        <td><label class="col-form-label f-w-600">Monto Total:</label></td>

                                                    </tr>
                                                    <tr>
                                                        <td>{{ $contract->provider->description }}</td>

                                                        {{-- SI ESTADO ESTA ANULADO, RESCINDIDO O CANCELADO --}}
                                                        @if (in_array($contract->contract_state_id, [2,3,4]))
                                                            <td style="color:#ff0000">{{ $contract->contractState->description }}</td>
                                                        @else
                                                            <td style="color:green">{{ $contract->contractState->description }}</td>
                                                        @endif

                                                        <td>{{ $contract->modality->description }}</td>
                                                        <td>{{ $contract->financialOrganism->description }}</td>
                                                        <td>{{ $contract->contractType->description }}</td>
                                                        <td colspan="2" style="font-size: 16px;color:blue;font-weight: bold">{{ 'Gs. '.$contract-> totalAmountFormat() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <h5 class="text-center">PÓLIZAS del LLAMADO</h5>
                                            <table class="table table-striped table-bcontracted">
                                                <tbody>
                                                    <tr>
                                                        <td><label class="col-form-label f-w-600" >ANTICIPO DESDE:</label></td>
                                                        <td><label class="col-form-label f-w-600" >ANTICIPO HASTA:</label></td>
                                                        <td><label class="col-form-label f-w-600">FIEL CUMPLIMIENTO DESDE:</label></td>
                                                        <td><label class="col-form-label f-w-600">FIEL CUMPLIMIENTO HASTA:</label></td>
                                                        <td><label class="col-form-label f-w-600">COBERT. ACCIDENTES DESDE:</label></td>
                                                        <td><label class="col-form-label f-w-600">COBERT. ACCIDENTES HASTA:</label></td>
                                                        <td><label class="col-form-label f-w-600">COBERT. RIESGOS DESDE:</label></td>
                                                        <td><label class="col-form-label f-w-600">COBERT. RIESGOS HASTA:</label></td>
                                                        <td><label class="col-form-label f-w-600">RESPONS. CIVIL DESDE:</label></td>
                                                        <td><label class="col-form-label f-w-600">RESPONS. CIVIL HASTA:</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $contract->advance_from_validityDateFormat() }}</td>
                                                        <td>{{ $contract->advance_to_validityDateFormat() }}</td>

                                                        {{-- @if (($contract->fidelity_from_validityDateFormat()-60) <= today())
                                                            <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_advance)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_advance )) }}</td>
                                                        @else
                                                            <td>{{ $contract->fidelity_from_validityDateFormat() }}</td>
                                                        @endif --}}
                                                        <td>{{ $contract->fidelity_to_validityDateFormat() }}</td>
                                                        
                                                        @if (($contract->fidelity_to_validityDateFormat()) <= today())
                                                            <td style="color:#ff0000">{{ is_null($contract->fidelity_to_validityDateFormat())? "-" : date('d/m/Y', strtotime($contract->fidelity_to_validityDateFormat())) }}</td>
                                                        @else
                                                            <td>{{ $contract->fidelity_to_validityDateFormat() }}</td>                                                        
                                                        @endif

                                                        <td>{{ $contract->fidelity_to_validityDateFormat() }}</td>

                                                        <td>{{ $contract->accidents_from_validityDateFormat() }}</td>
                                                        <td>{{ $contract->accidents_to_validityDateFormat() }}</td>
                                                        <td>{{ $contract->risks_from_validityDateFormat()}}</td>
                                                        <td>{{ $contract->risks_to_validityDateFormat() }}</td>
                                                        <td>{{ $contract->civil_resp_from_validityDateFormat()}}</td>
                                                        <td>{{ $contract->civil_resp_to_validityDateFormat() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab3" role="tabpanel">
                                            <div class="row">
                                                <table id="items" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Lote</th>
                                                            <th>Ítem</th>
                                                            <th>Cód. de Catál.</th>
                                                            <th>Descripción</th>
                                                            <th>EETT</th>
                                                            <th>Present.</th>
                                                            <th>U.M.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{-- @for ($i = 0; $i < count($order->items); $i++)
                                                        <tr>
                                                            <td>{{ ($i+1) }}</td>
                                                            <td>{{ $order->items[$i]->batch }}</td>
                                                            <td>{{ $order->items[$i]->item_number }}</td>                                                                
                                                            @if ($order->items[$i]->level5CatalogCode->code == '99999999-9999')                                                                    
                                                                <td class="columna3" style="color:red;font-weight: bold">{{ $order->items[$i]->level5CatalogCode->code }}</td>
                                                                <td style="color:red;font-weight: bold">{{ $order->items[$i]->level5CatalogCode->description }}</td>
                                                            @else
                                                                <td class="columna3"> {{ $order->items[$i]->level5CatalogCode->code }}</td>                                                                    
                                                                <td class="columna4"> {{ $order->items[$i]->level5CatalogCode->description }}</td>
                                                            @endif                                                                
                                                            <td>{{ $order->items[$i]->technical_specifications }}</td>
                                                            <td>{{ $order->items[$i]->orderPresentation->description }}</td>
                                                            <td>{{ $order->items[$i]->orderMeasurementUnit->description }}</td>                                                            
                                                                                                                        
                                                            
                                                            <td style="white-space:nowrap">
                                                                <button type="button" title="Listado de Precios Referenciales" class="btn btn-primary btn-icon" onclick="itemAwardHistories({{ $order->items[$i]->id }})">
                                                                    <i class="fa fa-list"></i>
                                                                </button>
                                                            @if (Auth::user()->hasPermission(['admin.items.update']) || $order->dependency_id == Auth::user()->dependency_id)
                                                                <button type="button" title="Editar" class="btn btn-warning btn-icon" onclick="updateItem({{ $order->items[$i]->id }})">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                            @endif
                                                            @if (Auth::user()->hasPermission(['admin.items.delete']) || $order->dependency_id == Auth::user()->dependency_id)
                                                                <button type="button" title="Borrar" class="btn btn-danger btn-icon" onclick="deleteItem({{ $order->items[$i]->id }})">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                    @endfor --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="text-right">
                                                @if (Auth::user()->hasPermission(['contracts.contracts.create','admin.orders.create']))
                                                    {{-- Si pedido está anulado no muestra agregar ítems --}}
                                                    @if ($contract->contract_state_id == 0)
                                                    @else
                                                        <a href="{{ route('contracts.create', $contract->id) }}" class="btn btn-primary">Agregar póliza</a>
                                                        <a href="{{ route('contracts.create', $contract->id)}}" title="Cargar Archivo EXCEL" class="btn btn-success btn-icon">
                                                        {{-- <a href="{{ route('admin.contracts.uploadExcel', $contract->id)}}" title="Cargar Archivo EXCEL" class="btn btn-success btn-icon"> --}}
                                                    @endif
                                                        <i class="fa fa-upload text-white"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        <span style="font-size: 16px; font-weight: bold; color:red;background-color:yellow;" >MONTO TOTAL DEL PEDIDO: {{ $contract->totalAmountFormat() }}</span>  
                                    </div>

                                    <div class="tab-pane" id="tab4" role="tabpanel">
                                        <table id="forms" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reporte</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Reporte 1</td>                                                    
                                                    <td><a href="/pdf/panel_contracts" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Total Llamados</a></td>
                                                    {{-- DEBE SER ASÍ EL REPORTE POR EL LLAMADO ESPECÍFICO --}}
                                                    {{-- <td><a href="/pdf/reporte1/{{ $order->id }}" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Ver Formulario 1</a></td> --}}
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Reporte 2</td>                                                    
                                                    <td><a href="/pdf/panel_contracts1" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Llamados en curso</a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Reporte 3</td>                                                    
                                                    <td><a href="/pdf/panel_contracts3" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Llamados cerrados</a></td>
                                                </tr>                                                
                                                <tr>
                                                    <td>4</td>
                                                    <td>Reporte 4</td>                                                    
                                                    <td><a href="/pdf/panel_contracts2" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Llamados rescindidos</a></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Reporte 5</td>                                                    
                                                    <td><a href="/pdf/panel_contracts4" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Detalle de pólizas</a></td>
                                                </tr>                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="tab5" role="tabpanel">
                                        <label class="col-form-label f-w-600">Archivos de pólizas cargados al llamado:</label>
                                        <table class="table table-striped table-bcontracted">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Descripción</th>
                                                    <th>Dependencia</th>
                                                    <th>Fecha/Hora</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @for ($i=0; $i < count($user_files); $i++)
                                                    <tr>
                                                        <td>{{ $i+1 }}</td>
                                                        <td>{{ $user_files[$i]->description }}</td>
                                                        <td>{{ $user_files[$i]->dependency->description }}</td>
                                                        <td>{{ $user_files[$i]->updated_atDateFormat() }}</td>
                                                        <td>
                                                            <a href="{{ asset('storage/files/'.$user_files[$i]->file) }}" title="Ver Archivo" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                            <a href="{{ route('contracts.files.download', $user_files[$i]->id) }}" title="Descargar Archivo" class="btn btn-info"><i class="fa fa-download"></i></a>
                                                            <button title="Eliminar Archivo" onclick="deleteFile({{ $user_files[$i]->id }})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endfor

                                                    @for ($i=0; $i < count($other_files); $i++)
                                                    <tr>
                                                        <td>{{ $i+1 }}</td>
                                                        <td>{{ $other_files[$i]->description }}</td>
                                                        <td>{{ $other_files[$i]->dependency->description }}</td>
                                                        <td>{{ $other_files[$i]->updated_atDateFormat() }}</td>
                                                        <td>
                                                            <a href="{{ asset('storage/files/'.$other_files[$i]->file) }}" title="Ver Archivo" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                            <a href="{{ route('contracts.files.download', $other_files[$i]->id) }}" title="Descargar Archivo" class="btn btn-info"><i class="fa fa-download"></i></a>
                                                    </td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            @if (in_array($contract->contract_state_id, [1,2]))
                                                <a href="{{ route('contracts.files.create', $contract->id) }}" class="btn btn-primary">Cargar Pólizas</a>
                                            @endif
                                        </div>
                                    </div>                                

                                    <div class="tab-pane" id="tab6" role="tabpanel">
                                            <label class="col-form-label f-w-600">Archivos de contratos cargados al llamado:</label>
                                            <table class="table table-striped table-bcontracted">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Descripción</th>
                                                        <th>Dependencia</th>
                                                        <th>Fecha/Hora</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @for ($i=0; $i < count($user_files); $i++)
                                                        <tr>
                                                            <td>{{ $i+1 }}</td>
                                                            <td>{{ $user_files[$i]->description }}</td>
                                                            <td>{{ $user_files[$i]->dependency->description }}</td>
                                                            <td>{{ $user_files[$i]->updated_atDateFormat() }}</td>
                                                            <td>
                                                                <a href="{{ asset('storage/files/'.$user_files[$i]->file) }}" title="Ver Archivo" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                                <a href="{{ route('contracts.files.download', $user_files[$i]->id) }}" title="Descargar Archivo" class="btn btn-info"><i class="fa fa-download"></i></a>
                                                                <button title="Eliminar Archivo" onclick="deleteFile({{ $user_files[$i]->id }})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endfor

                                                        @for ($i=0; $i < count($other_files); $i++)
                                                        <tr>
                                                            <td>{{ $i+1 }}</td>
                                                            <td>{{ $other_files[$i]->description }}</td>
                                                            <td>{{ $other_files[$i]->dependency->description }}</td>
                                                            <td>{{ $other_files[$i]->updated_atDateFormat() }}</td>
                                                            <td>
                                                                <a href="{{ asset('storage/files/'.$other_files[$i]->file) }}" title="Ver Archivo" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                                <a href="{{ route('contracts.files.download', $other_files[$i]->id) }}" title="Descargar Archivo" class="btn btn-info"><i class="fa fa-download"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                @if (in_array($contract->contract_state_id, [1,2]))
                                                    <a href="{{ route('contracts.files.create', $contract->id) }}" class="btn btn-primary">Cargar Contratos</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                </div>
                            </div>

                            {{-- MOSTRAMOS TIMELINE --}}
                            {{-- <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5 style="font-size: 14px; font-weight: bold; color:red" class="text-left">Movimientos del pedido</h5>
                                </div>
                                <div class="card-block">
                                    <div class="latest-update-box">
                                    @foreach ($contract->contractscontractstates()->contractBy('id', 'desc')->get() as $item)
                                        <div class="row p-t-20 p-b-30 borde-alternado">
                                            <div class="col-auto text-right update-meta p-r-0">
                                                <i class="update-icon ring"></i>
                                            </div>
                                            <div class="col p-l-5">
                                                <a href="javascript:void(0);">
                                                    <h6 style="font-size: 14px; font-weight: bold; color:Black">{{ $item->contractstate->id}}-{{ $item->contractstate->description}}</h6>
                                                </a>
                                                <p style="font-size: 14px; font-weight: bold; color:Black">{{ $item->creatorUser->getFullName()}}</p>
                                                <small style="font-size: 13px; font-weight: bold; color:Black">Fecha: {{ $item->createdAtDateFormat()}}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div> --}}
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

    updateContracts = function(budget){
        // persistirTab();
        location.href = '/contracts/{{ $contract->id }}/items_budget/'+budget+'/edit/';

        // location.href = '/contracts/{{ $contract->id }}/budget_request_providers/'+budget+'/edit_providers_contracts/';

        //  /items_budget = Route::resource('contracts.items_budget', BudgetRequestProvidersController::class);
        //  /edit = public function edit(Request $request, $contract_id) de BudgetRequestProvidersController
    }

    recibecontract = function(contract_id){
        $.ajax({
            url : '/contracts/recibe_contract/'+contract_id,
            method: 'POST',
            data: '_token='+'{{ csrf_token() }}',
            success: function(data){
                try{
                    response = (typeof data == "object") ? data : JSON.parse(data);
                    if(response.status == "success"){
                        swal({
                            title: "Exito!",
                            text: response.message,
                            type: "success"
                        },
                        function(isConfirm){
                            location.reload();
                        });
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

    derivecontract = function(contract_id){
        $.ajax({
            url : '/contracts/derive_contract/'+contract_id,
            method: 'POST',
            data: '_token='+'{{ csrf_token() }}',
            success: function(data){
                try{
                    response = (typeof data == "object") ? data : JSON.parse(data);
                    if(response.status == "success"){
                        swal({
                            title: "Exito!",
                            text: response.message,
                            type: "success"
                        },
                        function(isConfirm){
                            location.reload();
                        });
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

    itemAwardHistories = function(item){
        location.href = '/items/'+item+'/item_contract_histories';
    }

    deleteContract = function(id){
        swal({
            title: "Atención",
            text: "¿Está seguro que desea eliminar el llamado?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route("contracts.delete", ["contract_id" => ":id"]) }}'.replace(':id', id),
                    method: 'POST',
                    data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
                    success: function(data) {
                        try {
                            response = (typeof data == "object") ? data : JSON.parse(data);
                            if (response.status == "success") {
                                location.reload();
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        } catch (error) {
                            swal("Error!", "Ocurrió un error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
                            console.log(error);
                        }
                    },
                    error: function(error) {
                        swal("Error!", "Ocurrió 1 un error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
                        console.log(error);
                    }
                });
            }
        });
    }

    // deleteContract = function(id){
    //   swal({
    //         title: "Atención",
    //         text: "Está seguro que desea eliminar el llamado?",

    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#DD6B55",
    //         confirmButtonText: "Sí, eliminar",
    //         cancelButtonText: "Cancelar",
    //     },
    //     function(isConfirm){
    //       if(isConfirm){
    //         $.ajax({
    //         //   url : '/contracts/contract/'+id+'/delete/',
    //           url : '{{ route("contracts.delete", ["contract_id" => ":id"]) }}'.replace(':id', id),
    //           method : 'POST',
    //           data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
    //           success: function(data){
    //             try{
    //                 response = (typeof data == "object") ? data : JSON.parse(data);
    //                 if(response.status == "success"){
    //                     location.reload();
    //                 }else{
    //                     swal("Error!", response.message, "error");
    //                 }
    //             }catch(error){
    //                 swal("Error!", "Ocurrió un error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
    //                 console.log(error);
    //             }
    //           },
    //           error: function(error){
    //             swal("Error!", "Ocurrió 1 error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
    //             console.log(error);
    //           }
    //         });
    //       }
    //     }
    //   );
    // };

    deleteFile = function(file){
      swal({
            title: "Atención",
            text: "Está seguro que desea eliminar el registro?",

            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        },
        function(isConfirm){
          if(isConfirm){
            $.ajax({
              url : '/contracts/files/'+file+'/delete/',
              method : 'POST',
              data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
              success: function(data){
                try{
                    response = (typeof data == "object") ? data : JSON.parse(data);
                    if(response.status == "success"){
                        location.reload();
                    }else{
                        swal("Error!", response.message, "error");
                    }
                }catch(error){
                    swal("Error!", "Ocurrió un error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
                    console.log(error);
                }
              },
              error: function(error){
                swal("Error!", "Ocurrió 1 error intentado resolver la solicitud, por favor complete todos los campos o recargue de vuelta la pagina", "error");
                console.log(error);
              }
            });
          }
        }
      );
    };

    deleteObjection = function(objection){
      swal({
            title: "Atención",
            text: "Está seguro que desea eliminar el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        },
        function(isConfirm){
          if(isConfirm){
            $.ajax({
              url : '/contracts/{{ $contract->id }}/objections/'+objection,
              method : 'POST',
              data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
              success: function(data){
                try{
                    response = (typeof data == "object") ? data : JSON.parse(data);
                    if(response.status == "success"){
                        location.reload();
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

    deleteObjectionResponse = function(objection, objection_response){
      swal({
            title: "Atención",
            text: "Está seguro que desea eliminar el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        },
        function(isConfirm){
          if(isConfirm){
            $.ajax({
              url : '/contracts/'+objection+'/objections_responses/'+objection_response,
              method : 'POST',
              data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
              success: function(data){
                try{
                    response = (typeof data == "object") ? data : JSON.parse(data);
                    if(response.status == "success"){
                        location.reload();
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
