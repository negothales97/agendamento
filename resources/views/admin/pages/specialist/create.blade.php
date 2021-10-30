@extends('admin.templates.default')

@section('title', 'Especialista')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <form action="{{ route('admin.specialist.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Dados</h4>
                            </div>

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
                                    <input type="hidden" name="specialty_id" id="specialty_id"
                                        value="{{ old('specialty_id') }}">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <select name="specialty_category_id" class="form-control specialty_category_id">
                                                <option value="" disabled selected>Selecione...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        data-specialty_id="{{ $category->specialty_id }}"
                                                        {{ $category->id == old('specialty_category_id') ? 'selected' : '' }}>
                                                        Categoria: {{ $category->name }} - Especialidade:
                                                        {{ $category->specialty->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="picture" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Confirmação de senha</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Resumo</label>
                                            <textarea name="abstract" rows="5"
                                                class="form-control simple-text-editor">{{ old('abstract') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
                <div class="row">
                    <section class="col-lg-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Dados Bancários</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Código do banco</label>
                                            <input type="number" class="form-control" name="bank_code"
                                                value="{{ old('bank_code') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Agência</label>
                                            <input type="number" class="form-control" name="agencia"
                                                value="{{ old('agencia') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Dígito da agência (opcional)</label>
                                            <input type="number" class="form-control" name="agencia_dv"
                                                value="{{ old('agencia_dv') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Conta</label>
                                            <input type="number" class="form-control" name="conta"
                                                value="{{ old('conta') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Dígito</label>
                                            <input type="number" class="form-control" name="conta_dv"
                                                value="{{ old('conta_dv') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input type="text" class="form-control input-cpf" name="document_number"
                                                value="{{ old('document_number') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default pull-right">Adicionar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

@stop
@section('scripts')
    <script type="text/javascript">
        $('.specialty_category_id').on('change', function() {
            const specialty_id = $('.specialty_category_id option:selected').data('specialty_id');
            $('#specialty_id').val(specialty_id);
        });
    </script>
@endsection
