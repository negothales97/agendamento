@extends('admin.templates.default')

@section('title', 'Colaboradores')

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
                        <form action="{{ route('admin.customer.update', ['id' => $resource->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" name="first_name" class="form-control"
                                                value="{{ old('first_name', $resource->first_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>SobreNome</label>
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ old('last_name', $resource->last_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $resource->email) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <input type="text" name="cellphone" class="form-control input-phone"
                                                value="{{ old('cellphone', $resource->cellphone) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input type="text" name="document" class="form-control input-cpf"
                                                value="{{ old('document', $resource->document) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Confirmação de senha</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Atualizar</button>
                            </div>
                        </form>
                </section>
            </div>
        </section>
    </div>

@stop
