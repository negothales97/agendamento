@extends('admin.templates.default')

@section('title', 'Posts')

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
                        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Subtítulo</label>
                                            <input type="text" name="subtitle" class="form-control"
                                                value="{{ old('subtitle') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Autor</label>
                                            <input type="text" name="author" class="form-control"
                                                value="{{ old('author') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label >Imagem</label>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Conteúdo</label>
                                            <textarea name="content" rows="10" class="form-control medium-text-editor">{{old('content')}}</textarea>
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
