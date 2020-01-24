@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <a href="{{route('transactions.create')}}" class="btn btn-info">Registrar entrega da chave</a>
        <div class="card-header">
            <h2>Gerência de Chaves</h2>
        </div>
        <div class="card-body">
            <table id="example" class="table table-hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data/Hora</th>
                        <th>Responsável pela entrega da chave</th>
                        <th>Reponsável pela chave</th>
                        <th>Chaves</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $t)
                    <tr>
                        <td>
                            {{$t->id}}
                        </td>
                        <td>{{date('d/m/Y - h:m', strtotime($t->created_at))}}</td>
                        <td>{{$users[$t->gatekeeper_id]}}</td>
                        <td>{{$users[$t->user_id]}}</td>
                        <td>
                            @foreach ($t->transaction_keys()->join('keys', 'keys.id', '=',
                            'transaction_keys.key_id')->select('keys.name')->get() as $tk)
                            <div>{{$tk->name}}</div>
                            @endforeach
                        </td>
                        <td>
                            <button id="button-{{$t->id}}" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#return-modal"
                                data-action="{{route('transactions.update', ['transaction' => $t->id])}}">
                                Devolver
                            </button>

                            <script>
                                $(document).ready(function () {
                                    $('#button-{{$t->id}}').on('click', function (event) {
                                        var transaction_action = $(this).data('action');
                                        $('#return-form').attr('action', transaction_action);
                                        $('#select-keys option').each(function () {
                                            $(this).remove();
                                        });
                                        @foreach($t->transaction_keys()->where('transaction_keys.transaction_id', $t->id)
                                            ->join('keys as k', 'transaction_keys.key_id', '=','k.id') 
                                            ->select('transaction_keys.transaction_id','transaction_keys.key_id', 'k.name') 
                                            ->get() as $key)
                                            $('#select-keys').append('<option value="{{$key->key_id}}" selected>{{$key->name}}</option>');
                                        @endforeach
                                    });
                                });

                            </script>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">Nenhum registro encontrado!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$transactions->links()}}
        </div>

        <form id="return-form" action="" method="post">
            @csrf
            @method("PUT")
            <div class="modal" id="return-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Devolução da Chave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user">Nome do responsável pela devolução</label>
                                {!! Form::select('user', $users
                                , null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="keys">Chaves</label>
                                <select class="form-control input-lg" multiple="" id="select-keys"
                                    data-placeholder="Escolha pelo menos um" name="keys[]">

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Devolver</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- container -->
    @endsection
