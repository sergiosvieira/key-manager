@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Alterar Setor</h2>
        </div>
        <div class="card-body">
            <form action="{{route('sectors.update', ['sector'=>$sector->id])}}" method="post">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Nome do Setor</label>
                    <input type="text" class="form-control" name="name" value="{{$sector->name}}"
                        placeholder="Digite o nome do setor" required>
                    {!! Form::label('sub_sectors', 'Selecione os subsetores associados ao setor (segure ctrl para
                    selecionar vários)') !!}
                    {!! Form::select('sub_sectors[]', $sub_sectors, $current, ['class' => 'form-control input-lg',
                    'multiple', 'id' => 'prettify']) !!}
                </div>
                <button type="submit" class="btn btn-info">Salvar Alterações</button>
                <a href="{{ url()->previous() }}" class="btn btn-info">Voltar</a>
            </form>
        </div>
        <div class="card-footer">
            <form action="{{route('sectors.destroy', ['sector' => $sector->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
        </div>
    </div>
</div>
@endsection
