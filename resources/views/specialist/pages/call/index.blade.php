@extends('specialist.templates.default')

@section('title', 'Chamada de vídeo')

@section('description', 'Descrição')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Agendamentos</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome cliente</th>
                                        <th>Data</th>
                                        <th>Horário inicial</th>
                                        <th>Horário final</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->customer->full_name }}</td>
                                            <td>{{ convertDateUSAtoBrazil($schedule->date) }}</td>
                                            <td>{{ $schedule->init_hour }}</td>
                                            <td>{{ $schedule->final_hour }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('specialist.call.show', ['id' => $schedule->id]) }}"
                                                        class="btn">
                                                        <i class="fa fa-video-camera"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                Nenhum dado dispónível
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@stop
