@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Criar Setor</h2>
        </div>
        <div class="card-body">
            <form action="{{route('sectors.store')}}" method="post">
                @csrf
                @method("POST")
                <div class="form-group">
                    <label for="name">Nome do Setor</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite o nome do setor" required>
                    {!! Form::label('sub_sectors', 'Selecione os subsetores associados ao setor (segure ctrl para
                    selecionar vários):') !!}
                    {!! Form::select('sub_sectors[]', $sub_sectors, null, ['class' => 'form-control input-lg',
                    'multiple', 'id' =>
                    'prettify', 'data-placeholder' => 'Choose at least one tag']) !!}
                </div>
                <button type="submit" class="btn btn-info">Salvar</button>
                <a href="{{ url()->previous() }}" class="btn btn-info">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection
