@extends('specialist.templates.default')

@section('title', 'Calendário')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-success btn-add-schedule"><i class="fa fa-plus"></i> Disponibilizar
                        horário</button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <section class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <input type="hidden" name="specialist_id" id="specialist_id"
                                value="{{ auth('specialist')->id() }}">
                            <input type="hidden" name="use_online" id="use_online"
                                value="{{ auth('specialist')->user()->use_online }}">
                            <div id="calendar">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        </section>
    </div>

@stop

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('.btn-add-schedule').on('click', function() {
            $('#modalSchedule').modal('show');
        });
    </script>
@endsection
