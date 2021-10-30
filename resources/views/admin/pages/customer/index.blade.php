@extends('admin.templates.default')

@section('title', 'Usuários')

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
                        <div class="box-header pull-right">
                            {{ $resources->links() }}
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($resources as $resource)
                                        <tr>
                                            <td>{{ $resource->full_name }}</td>
                                            <td>{{ $resource->email }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.customer.edit', ['id' => $resource->id]) }}"
                                                        class="btn">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </a>
                                                    <button type="button"
                                                        data-action="{{ route('admin.customer.delete', ['id' => $resource->id]) }}"
                                                        class="btn btn-delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Nenhum dado cadastrado</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>

@stop
