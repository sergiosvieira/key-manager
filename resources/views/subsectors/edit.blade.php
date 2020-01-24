@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Alterar Subsetor</h2>
        </div>
        <div class="card-body">
            <form action="{{route('subsectors.update', ['subsector'=>$subsector->id])}}" method="post">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Nome do Subsetor</label>
                    <input type="text" class="form-control" name="name" value="{{$subsector->name}}"
                        placeholder="Digite o nome do setor" required>
                </div>
                <button type="submit" class="btn btn-info">Salvar Alterações</button>
                <a href="{{ url()->previous() }}" class="btn btn-info">Voltar</a>
            </form>
        </div>
        <div class="card-footer">
            <form action="{{route('subsectors.destroy', ['subsector' => $subsector->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
        </div>
    </div>
</div>
@endsection
