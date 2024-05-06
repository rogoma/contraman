@extends('layouts.app')

@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fa fa-sitemap bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Modalidades</h5>
                        <span>Agregar Modalidad</span>
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
                            <a href="{{ route('modalities.index') }}">Modalidades</a>
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
                                    <h5>Agregar Modalidad</h5>
                                </div>
                                <div class="card-block">
                                    <form method="POST" action="{{ route('modalities.store') }}">
                                        @csrf

                                        <div class="form-group row @error('description') has-danger @enderror">
                                            <label class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="description" name="description" value="{{ old('description') }}" class="form-control @error('description') form-control-danger @enderror" value="{{ old('description') }}">
                                                @error('description')
                                                    <div class="col-form-label">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>   
                                        <div class="form-group row @error('code') has-danger @enderror">
                                            <label class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="code" name="code" value="{{ old('code') }}" class="form-control @error('code') form-control-danger @enderror" value="{{ old('code') }}">
                                                @error('code')
                                                    <div class="col-form-label">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>                                     
                                        <div class="form-group row @error('modality_type') has-danger @enderror">
                                            <label class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="modality_type" name="modality_type" value="{{ old('modality_type') }}" class="form-control @error('modality_type') form-control-danger @enderror" value="{{ old('modality_type') }}">
                                                @error('modality_type')
                                                    <div class="col-form-label">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary m-b-0">Guardar</button>
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