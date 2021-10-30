@extends('admin.templates.default')

@section('title', 'Especialidades')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Dados</h4>
                        </div>
                        <form action="{{ route('admin.specialty.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Ícone <small>(Tamanho: 56px X 56px)</small></label>
                                            <input type="file" name="icon" class="form-control"
                                                value="{{ old('icon') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Imagem de fundo </label>
                                            <input type="file" name="background_image" class="form-control"
                                                value="{{ old('background_image') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Background</label>
                                            <input type="color" name="background" class="form-control"
                                                value="{{ old('background') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Adicionar</button>
                            </div>
                        </form>
                </section>
            </div>
        </section>
    </div>

@stop
