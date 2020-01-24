@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Criar Subsetor</h2>
        </div>
        <div class="card-body">
            <form action="{{route('subsectors.store')}}" method="post">
                @csrf
                @method("POST")
                <div class="form-group">
                    <label for="name">Nome do Subsetor</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite o nome do subsetor"
                        required>
                </div>
                <button type="submit" class="btn btn-info">Salvar</button>
                <a href="{{ url()->previous() }}" class="btn btn-info">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection
