@extends('specialist.templates.default')

@section('title', 'Dashboard')

@section('description', 'Descrição')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-4 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3>R$ {{ formatIntegerToDecimal($balance->waiting_funds->amount) }}</h3>

                                    <p>Saldo a liberar</p>
                                </div>
                                <a href="{{ route('specialist.balance.index') }}" class="small-box-footer">Mais
                                    informações</a>
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
                                <a href="{{ route('specialist.balance.index') }}" class="small-box-footer">Mais
                                    informações</a>
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
                                <a href="{{ route('specialist.balance.index') }}" class="small-box-footer">Mais
                                    informações</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Agendamentos por mês</h3>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="height:403px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Últimos agendamentos</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Cliente</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lastSchedules as $schedule)
                                                <tr>
                                                    <td>{{ convertDateUSAtoBrazil($schedule->date) }}
                                                        {{ $schedule->init_hour }} - {{ $schedule->final_hour }}</td>
                                                    <td>{{ "{$schedule->customer_first_name} {$schedule->customer_last_name}" }}
                                                    </td>
                                                    <td>R${{ formatIntegerToDecimal($schedule->price) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Nenhum dado até o momento</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@stop

@section('scripts')
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <script>
        $(function() {

            var areaChartData = {
                labels: ['Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro'],
                datasets: [{
                    label: 'Agendamentos',
                    fillColor: 'rgba(210, 214, 222, 1)',
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [0, 0, 0, 0, 0, {{ $totalSchedules }}]
                }]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChart = new Chart(barChartCanvas)
            var barChartData = areaChartData
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            }

            barChartOptions.datasetFill = false
            barChart.Bar(barChartData, barChartOptions)
        });
    </script>
@endsection
