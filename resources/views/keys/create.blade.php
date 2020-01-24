@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Criar Registro de Chave</h2>
        </div>
        <div class="card-body">
            <form action="{{route('keys.store')}}" method="post">
                @csrf
                @method("POST")
                <div class="form-group">
                    <label for="sector_id">Setor</label>
                    {!! Form::select('sector_id', $sectors, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="sector_id">Subsetor</label>
                    {!! Form::select('sub_sector_id', $sub_sectors, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="name">Identificação da chave</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite o nome do setor" required>
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
