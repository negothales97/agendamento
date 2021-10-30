@extends('admin.templates.default')

@section('title', 'Calendário')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-success" onclick="showFilters();"><i class="fa fa-plus"></i> Disponibilizar horário</button>
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
                            <div class="calendar"></div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        </section>
    </div>

@stop

@section('modals')

<div class="modal fade" id="filters">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Disponibilizar horário</h4>
            </div>
            <form id="delete-form" action="" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Data</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Início</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Fim</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Valor</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        R$
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Disponibilizar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script src="{{ asset('adminlte/bower_components/moment/moment.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/fullcalendar/dist/locale/pt-br.js')}}"></script>

<script>
    function showFilters(){
        $('#filters').modal('show');
    }

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    $('.calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : ''
      },
      buttonText: {
        today: 'Hoje',
        month: 'mês'
      },

      //Random default events
      events    : [
        {
          title          : 'Consulta agendada',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#dd4b39',
          borderColor    : '#dd4b39'
        },
        {
          title          : 'Disponível',
          start          : new Date(y, m, d, 12, 30),
          allDay         : false,
          backgroundColor: '#f39c12',
          borderColor    : '#f39c12'
        },
        {
          title          : 'Disponível',
          start          : new Date(y, m, d, 16, 30),
          allDay         : false,
          backgroundColor: '#f39c12',
          borderColor    : '#f39c12'
        },
        {
          title          : 'Disponível',
          start          : new Date(y, m, d - 1, 10, 30),
          allDay         : false,
          backgroundColor: '#f39c12',
          borderColor    : '#f39c12'
        },
        {
          title          : 'Consulta agendada',
          start          : new Date(y, m, d + 2, 12, 30),
          allDay         : false,
          backgroundColor: '#dd4b39',
          borderColor    : '#dd4b39'
        },
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start           = date;
        copiedEventObject.allDay          = allDay;
        copiedEventObject.backgroundColor = $(this).css('background-color');
        copiedEventObject.borderColor     = $(this).css('border-color');

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });
</script>
@endsection
