@extends('specialist.templates.default')

@section('title', 'Locais de atendimento')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-success btn-place"><i class="fa fa-plus"></i> Cadastrar novo</button>
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
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Endereço</th>
                                        <th>Número</th>
                                        <th>Estado</th>
                                        <th>Cidade</th>
                                        <th>Bairro</th>
                                        <th>CEP</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Atendimento Online</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <div class="btn-group ">
                                                <a href="{{ route('specialist.place.use-online', ['id' => auth('specialist')->id()]) }}"
                                                    class="btn btn-sm">
                                                    @if (auth('specialist')->user()->use_online == 1)
                                                        <i class="fa fa-toggle-on"></i>
                                                    @else
                                                        <i class="fa fa-toggle-off"></i>
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{ $resource->name }}</td>
                                            <td>{{ $resource->street }}</td>
                                            <td>{{ $resource->number }}</td>
                                            <td>{{ $resource->uf }}</td>
                                            <td>{{ $resource->city }}</td>
                                            <td>{{ $resource->district }}</td>
                                            <td>{{ $resource->zip_code }}</td>
                                            <td>
                                                <div class="btn-group ">
                                                    <a href="{{ route('specialist.place.update', ['id' => $resource->id]) }}"
                                                        class="btn btn-edit-place btn-sm" data-place="{{ $resource }}">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ route('specialist.place.status', ['id' => $resource->id]) }}"
                                                        class="btn btn-sm">
                                                        @if ($resource->status == 1)
                                                            <i class="fa fa-toggle-on"></i>
                                                        @else
                                                            <i class="fa fa-toggle-off"></i>
                                                        @endif
                                                    </a>
                                                    <button type="button" class="btn btn-delete btn-sm"
                                                        data-action="{{ route('specialist.place.delete', ['id' => $resource->id]) }}">
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

@section('modals')

    <div class="modal fade" id="placeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Local de atendimento</h4>
                </div>
                <form action="{{ route('specialist.place.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" class="method">
                    <input type="hidden" name="specialist_id" value="{{auth('specialist')->id()}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nome do local</label>
                                    <input type="text" name="name" id="name-place" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input type="text" id="cep-place" name="zip_code" class="form-control input-cep">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" id="street-place" name="street" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="text" id="number-place" name="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" id="district-place" name="district" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" id="city-place" name="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>UF</label>
                                    <select class="form-control" id="uf-place" name="uf">
                                        <option value="" disabled selected>Selecione..</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
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

@section('scripts')
    <script>
        $('.btn-place').on('click', function() {
            $('#placeModal #name-place').val('');
            $('#placeModal #cep-place').val('');
            $('#placeModal #street-place').val('');
            $('#placeModal #number-place').val('');
            $('#placeModal #district-place').val('');
            $('#placeModal #city-place').val('');
            $('#placeModal #uf-place').val('');
            $('#placeModal form').attr('action', `{{ route('specialist.place.store') }}`);
            $('#placeModal .method').val('');

            $('#placeModal .modal-title').text('Adicionar local de atendimento');
            $('#placeModal').modal('show');
        });

        $('.btn-edit-place').on('click', function(e) {
            e.preventDefault();
            let place = $(this).data('place');
            let action = $(this).attr('href');

            $('#placeModal #name-place').val(place.name);
            $('#placeModal #cep-place').val(place.zip_code);
            $('#placeModal #street-place').val(place.street);
            $('#placeModal #number-place').val(place.number);
            $('#placeModal #district-place').val(place.district);
            $('#placeModal #city-place').val(place.city);
            $('#placeModal #uf-place').val(place.uf);
            $('#placeModal form').attr('action', action);
            $('#placeModal .method').val('put');

            $('#placeModal .modal-title').text('Atualizar local de atendimento');
            $('#placeModal').modal('show');

        });
    </script>
@endsection
