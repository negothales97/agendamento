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
                        <form action="{{ route('admin.admin.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Tipo de acesso</label>
                                            <select name="role_id" class="form-control">
                                                <option value="" disabled selected>Selecione...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role->id == old('role_id') ? 'selected' : '' }}>
                                                        {{ $role->label }}</option>
                                                @endforeach
                                            </select>
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
                                <button type="submit" class="btn btn-default">Adicionar</button>
                            </div>
                        </form>
                </section>
            </div>
        </section>
    </div>

@stop
