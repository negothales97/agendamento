@extends('admin.templates.default')

@section('title', 'Especialidades')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-success" onclick="window.location.href=`{{ route('admin.specialty.create') }}`">
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
                                        <th>Ícone</th>
                                        <th>Nome</th>
                                        <th>Background</th>
                                        <th>Total de categorias</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($resources as $resource)
                                        <tr>
                                            <td><img style="max-width: 50px" src="{{ $resource->image_url }}"
                                                    alt="{{ $resource->name }}"></td>
                                            <td>{{ $resource->name }}</td>
                                            <td>
                                                <div class="color-preview"
                                                    style="background: {{ $resource->background }}"></div>
                                            </td>
                                            <td>{{ $resource->categories->count() }} categoria(s)</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.specialty.edit', ['id' => $resource->id]) }}"
                                                        class="btn">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-delete"
                                                        data-action="{{ route('admin.specialty.delete', ['id' => $resource->id]) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Nenhum dado cadastrado.</td>
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
