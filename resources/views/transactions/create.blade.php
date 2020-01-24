@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Entregar Chave</h2>
        </div>
        <div class="card-body">
            <form action="{{route('transactions.store')}}" method="post">
                @csrf
                @method("POST")
                <div class="form-group">
                    <label for="gatekeeper_id">Responsável pela entrega da chave</label>
                    {!! Form::select('gatekeeper_id', $gatekeepers
                    , null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="user_id">Responsável pela chave</label>
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('keys[]', $keys, null, ['class' => 'form-control input-lg',
                    'multiple', 'id' =>
                    'prettify', 'data-placeholder' => 'Escolha pelo menos um']) !!}
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Salvar</button>
            <a href="{{ url()->previous() }}" class="btn btn-info">Voltar</a>
        </div>
        </form>
    </div>
</div>
</div>
@endsection
