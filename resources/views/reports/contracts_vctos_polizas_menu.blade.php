@extends('layouts.app')

@push('styles')
    <style type="text/css">
        .table td,
        .table th {
            padding: 0.2rem 0.5rem;
            font-size: 14px
        }

        .tab-content.card-block {
            padding: 1.25rem 0.5rem;
        }

        p.centrado {}
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
                            <h5>Alertas de Pólizas y Endosos</h5>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <br>
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
                                        <div class="float-left">
                                            <h5>Listado de Alertas de Pólizas y Endosos</h5>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="contracts" class="table table-striped table-bordered">
                                                @if (!$contracts_poli->isNotEmpty())
                                                    <table>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>ID</th>
                                                            <th>Dependencia</th>
                                                            <th>Ver</th>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <h3 style="color:#ff0000">LISTADO DE ALERTAS</h3>
                                                    <table id="items" class="table table-striped table-bordered">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>ID</th>
                                                            <th>Dependencia</th>
                                                            <th>Ver</th>
                                                        </tr>

                                                        @for ($i = 0; $i < count($contracts_poli); $i++)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>
                                                                <td> {{ $contracts_poli[$i]->dependency_id }}</td>
                                                                <td> {{ $contracts_poli[$i]->dependencia }}</td>
                                                                <td>
                                                                    <a href="/pdf/panel_contracts9" title="Ver Archivo" target="_blank" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf-o"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endfor

                                                        @for ($j = 0; $j < count($contracts_endo); $j++)
                                                            <tr>
                                                                <td>{{ $i + ($j + 1) }}</td>
                                                                <td> {{ $contracts_endo[$j]->dependency_id }}</td>
                                                                <td> {{ $contracts_endo[$j]->dependencia }}</td>
                                                                <td>
                                                                    {{-- <button type="button" title="Editar"
                                                                        class="btn btn-danger btn-icon" onclick="updateItem({{ $contracts_endo[$j]->dependency_id }})">
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                    </button> --}}
                                                                    <a href="/pdf/panel_contracts9" title="Ver Archivo" target="_blank" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf-o"></i></a>
                                                                    {{-- <a href="/pdf/panel_contracts7" class="btn btn-outline-warning" target="_blank">EN CURSO</a> --}}
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </table>
                                                @endif
                                            </table>
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
