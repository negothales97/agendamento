@extends('admin.templates.default')

@section('title', 'Colaboradores')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-success" onclick="window.location.href=`{{ route('admin.admin.create') }}`">
                        <i class="fa fa-plus"></i> Cadastrar novo
                    </button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header pull-right">
                                {{ $resources->links() }}
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Acesso</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{ $resource->name }}</td>
                                            <td>{{ $resource->email }}</td>
                                            <td>{{ $resource->role_name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.admin.edit', ['id' => $resource->id]) }}"
                                                        class="btn">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </a>
                                                    <button type="button"
                                                        data-action="{{ route('admin.admin.delete', ['id' => $resource->id]) }}"
                                                        class="btn btn-delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
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
