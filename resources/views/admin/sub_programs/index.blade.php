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
                        <h5>Sub Programas</h5>
                        <span>Listado de Sub Programas</span>
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
                            <a href="{{ route('sub_programs.index') }}">Sub Programas</a>
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
                                        <h5>Listado de Sub Programas</h5>
                                    </div>
                                    <div class="float-right">
                                        <a href="{{ route('sub_programs.create') }}" class="btn btn-primary">Agregar Sub Programa</a>  
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="sub_programs" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Programa</th>
                                                    <th>Sub Programa</th>
                                                    <th>Código de actividad</th>                                                    
                                                    <th>Proyecto</th>
                                                    <th>unidad de medida</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @for ($i = 0; $i < count($sub_programs); $i++)
                                                <tr>
                                                    <td>{{ ($i+1) }}</td>
                                                    <td>{{ $sub_programs[$i]->program_id }}</td>
                                                    <td>{{ $sub_programs[$i]->description }}</td>
                                                    <td>{{ $sub_programs[$i]->activity_code }}</td>
                                                    <td>{{ $sub_programs[$i]->proyecto }}</td>                                                    
                                                    <td>{{ $sub_programs[$i]->program_measurement_unit_id }}</td>
                                                    <td>
                                                        <button type="button" title="Editar" class="btn btn-warning btn-icon" onclick="updateSubProgram({{ $sub_programs[$i]->id }})">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button type="button" title="Borrar" class="btn btn-danger btn-icon" onclick="deleteSubProgram({{ $sub_programs[$i]->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endfor
                                            </tbody>
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

@push('scripts')
<script src="{{ asset('template-admin/js/jquery.datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template-admin/js/datatables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template-admin/js/datatables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template-admin/js/datatables.responsive.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#sub_programs').DataTable();

    updateSubProgram = function(sub_program){
        location.href = '/sub_programs/'+sub_program+'/edit/';  
    }

    deleteSubProgram = function(sub_program){
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
              url : '/sub_programs/'+sub_program,
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