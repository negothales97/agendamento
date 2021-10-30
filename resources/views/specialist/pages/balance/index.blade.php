@extends('specialist.templates.default')

@section('title', 'Movimentações')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <h3>R$ {{ formatIntegerToDecimal($balance->waiting_funds->amount) }}</h3>

                            <p>Saldo a liberar</p>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <h3>R$ {{ formatIntegerToDecimal($balance->available->amount) }}</h3>

                            <p>Saldo Disponível</p>
                        </div>
                        <a href="{{ route('specialist.balance.transfer') }}" class="small-box-footer btn-balance-transfer"
                            data-max_amount="{{ formatIntegerToDecimal($balance->available->amount) }}">Resgatar </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <h3>{{ $totalSchedules }}</h3>

                            <p>Agendamentos realizados</p>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Nome do cliente</th>
                                        <th>E-mail do cliente</th>
                                        <th>Valor da transação</th>
                                        <th>Valor líquido</th>
                                        <th>Descrição</th>
                                        <th>Status transação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                {{ convertDateUSAtoBrazil($transaction->created_at) }}
                                            </td>
                                            <td>{{ $transaction->customer->full_name ?? '-' }}</td>
                                            <td>{{ $transaction->customer->email ?? '-' }}</td>
                                            <td>
                                                {{ $transaction->type == 'transfer' || $transaction->type == 'chargeback' ? '-' : '' }}
                                                R$ {{ formatIntegerToDecimal($transaction->value) }}
                                            </td>
                                            <td>
                                                @if($transaction->value_specialist == 0)
                                                 -
                                                @else
                                                {{ $transaction->type == 'transfer' || $transaction->type == 'chargeback' ? '-' : '' }}
                                                R$ {{formatIntegerToDecimal($transaction->value_specialist)}}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $transaction->description }}
                                            </td>
                                            <td>{{ $transaction->status_name }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>

@stop

@section('scripts')
    <script>
        $('.btn-balance-transfer').on('click', function(e) {
            e.preventDefault();
            let maxAmount = $(this).data('max_amount');
            const href = $(this).attr('href');

            $('#amount').val(maxAmount)
            $('#balanceTransferModal form').attr('action', href);
            $('#balanceTransferModal').modal('show');
        });
    </script>
@endsection
@section('modals')
    <div class="modal fade" id="balanceTransferModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Resgatar</h4>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Deseja prosseguir com a solicitação?</p>
                                <input type="hidden" id="amount" name="amount" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
