@extends('admin.templates.default')

@section('title', 'Configurações')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <form action="{{ route('admin.variable.update', ['id' => $resource->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <!-- Left col -->

                    <section class="col-lg-6">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Dados</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tolerância para chamadas</label>
                                            <input type="number" name="tolerance_mins" class="form-control"
                                                value="{{ old('tolerance_mins', $resource->tolerance_mins) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Minutos extras do chat</label>
                                            <input type="number" name="mins_available_after_closing" class="form-control"
                                                value="{{ old('mins_available_after_closing', $resource->mins_available_after_closing) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="col-lg-6">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Split</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Porcentagem para Avivare</label>
                                            <div class="input-group">
                                                <input type="text" value="{{ old('percentage', $resource->percentage) }}"
                                                    class="form-control pull-right input-money" name="percentage" />
                                                <div class="input-group-addon">
                                                    %
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Valores do estorno</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Mais de 30 dias
                                                </div>
                                                <input type="text" value="{{ old('chargeback_1', $resource->chargeback_1) }}"
                                                    class="form-control pull-right input-money" name="chargeback_1" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    20 e 30 dias
                                                </div>
                                                <input type="text" value="{{ old('chargeback_2', $resource->chargeback_2) }}"
                                                    class="form-control pull-right input-money" name="chargeback_2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    10 e 20 dias
                                                </div>
                                                <input type="text" value="{{ old('chargeback_3', $resource->chargeback_3) }}"
                                                    class="form-control pull-right input-money" name="chargeback_3" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Menos de  10 dias
                                                </div>
                                                <input type="text" value="{{ old('chargeback_4', $resource->chargeback_4) }}"
                                                    class="form-control pull-right input-money" name="chargeback_4" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default">Atualizar tudo</button>
                    </div>
                </div>
            </form>

        </section>
    </div>

@stop
