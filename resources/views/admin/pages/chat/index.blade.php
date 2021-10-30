@extends('admin.templates.default')

@section('title', 'Chat')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <!-- <div class="col-sm-6">
                    <button class="btn btn-success"><i class="fa fa-plus"></i> Cadastrar novo</button>
                    <button class="btn btn-primary" onclick="showFilters();"><i class="fa fa-filter"></i> Filtrar</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="dropdown"><i class="fa fa-list"></i> Ações em massa</button>
                        <button type="button" class="btn btn-default dropdown-toggle" >
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Excluir selecionados</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Exportar selecionados</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Exportar todos</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container">
            <!-- Direct Chat -->
            <div class="row">
              <div class="col-sm-4">
                <div class="box box-primary direct-chat direct-chat-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Minhas conversas</h3>
                  </div>
                  <div class="box-body" style="height: 469px;">
                    @for ($i = 0; $i < 5; $i++)
                      <div class="box-contact">
                        <div>
                          <img class="direct-chat-img" src="{{ asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="Message User Image">
                        </div>
                        <div>
                          <p class="p-user">Carlos Roberto</p>
                          <p class="p-message">Olá! Poxa, que legal</p>
                        </div>
                      </div>
                      <div class="box-contact">
                        <div>
                          <img class="direct-chat-img" src="{{ asset('adminlte/dist/img/user7-128x128.jpg')}}" alt="Message User Image">
                        </div>
                        <div>
                          <p class="p-user">Amanda Rocha</p>
                          <p class="p-message">Boa noite, doutor!</p>
                        </div>
                      </div>
                    @endfor
                  </div>
                </div>
              </div>
              <div class="col-sm-7">
                <!-- DIRECT CHAT PRIMARY -->
                <div class="box box-primary direct-chat direct-chat-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Carlos Roberto</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height: 415px;">
                      <!-- Message. Default to the left -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                          <span class="direct-chat-timestamp pull-left">23 Jan 2:00 pm</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <div class="direct-chat-text">
                          Olá tudo bem? Marquei consulta
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->

                      <!-- Message to the right -->
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                          <span class="direct-chat-timestamp pull-right">23 Jan 2:05 pm</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <div class="direct-chat-text">
                          Olá! Poxa, que legal
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                        <input type="text" name="message" placeholder="Mensagem" class="form-control">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-primary btn-flat">Enviar</button>
                            </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.box-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->
            </div>
          </div>
        </section>

        </section>
    </div>

@stop
