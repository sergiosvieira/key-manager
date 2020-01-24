@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Alterar Setor</h2>
        </div>
        <div class="card-body">
            <form action="{{route('keys.update', ['key'=>$key->id])}}" method="post">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="sector_id">Setor</label>
                    {!! Form::select('sector_id', $sectors, $key->sector_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="sector_id">Subsetor</label>
                    {!! Form::select('sub_sector_id', $sub_sectors, $key->sub_sector_id, ['class' => 'form-control'])
                    !!}
                </div>
                <div class="form-group">
                    <label for="name">Identificação da chave</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite o nome do setor"
                        value="{{$key->name}}" required>
                </div>
                <button type="submit" class="btn btn-info">Salvar Alterações</button>
                <a href="{{ url()->previous() }}" class="btn btn-info">Voltar</a>
            </form>
        </div>
        <div class="card-footer">
            <form action="{{route('keys.destroy', ['key' => $key->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
        </div>
    </div>
</div>
@endsection
