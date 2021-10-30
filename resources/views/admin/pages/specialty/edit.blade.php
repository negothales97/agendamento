@extends('admin.templates.default')

@section('title', 'Especialidades')

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
                        <div class="box-header">
                            <h4 class="box-title">Dados</h4>
                        </div>
                        <form action="{{ route('admin.specialty.update', ['id' => $resource->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $resource->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Ícone <small>(Tamanho: 56px X 56px)</small></label>
                                                    <input type="file" name="icon" class="form-control"
                                                        value="{{ old('icon') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Anterior:</p>
                                                <img style="max-width: 100px;" src="{{ $resource->image_url }}"
                                                    alt="{{ $resource->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Imagem de fundo</label>
                                                    <input type="file" name="background_image" class="form-control"
                                                        value="{{ old('background_image') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Anterior:</p>
                                                <img style="max-width: 100px;" src="{{ $resource->background_image_url }}"
                                                    alt="{{ $resource->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Background</label>
                                            <input type="color" name="background" class="form-control"
                                                value="{{ old('background', $resource->background) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Atualizar</button>
                            </div>
                        </form>
                </section>
            </div>
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Categorias da especialidade</h4>
                            <div class="box-tools">
                                <button class="btn btn-create-category">
                                    <i class="fa fa-plus"></i> Cadastrar novo
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($resource->categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.specialty.category.update', ['id' => $category->id]) }}"
                                                        class="btn btn-edit-category" data-category="{{ $category }}">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-delete"
                                                        data-action="{{ route('admin.specialty.category.delete', ['id' => $category->id]) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Nenhum dado cadastrado</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                </section>
            </div>
        </section>
    </div>

@stop
@section('scripts')
    <script type="text/javascript">
        $('.btn-create-category').on('click', function() {
            $('#categoryModal #input-name').val('');
            $('#categoryModal form').attr('action', `{{ route('admin.specialty.category.store') }}`);
            $('#categoryModal .method').val('');

            $('#categoryModal .modal-title').text('Adicionar Categoria');
            $('#categoryModal').modal('show');
        });
        $('.btn-edit-category').on('click', function(e) {
            e.preventDefault();
            let category = $(this).data('category');
            let action = $(this).attr('href');

            $('#categoryModal #input-name').val(category.name);
            $('#categoryModal form').attr('action', action);
            $('#categoryModal .method').val('put');

            $('#categoryModal .modal-title').text('Atualizar Categoria');
            $('#categoryModal').modal('show');
        });
    </script>
@endsection
@section('modals')
    <div class="modal fade" id="categoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Adicionar Categoria</h4>
                </div>
                <form action="{{ route('admin.specialty.category.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" class="method">
                        <input type="hidden" name="specialty_id" value="{{ $resource->id }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="name" id="input-name" class="form-control" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
