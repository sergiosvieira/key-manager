@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
    <a href="{{route('sectors.create')}}" class="btn btn-info">Adicionar novo</a>
    <div class="card-header">
        <h2>Lista de Setores</h2>
    </div>
    <div class="card-body">
        <table id="example" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do Setor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sectors as $sector)
                <tr>
                    <td>{{$sector->id}}</td>
                    <td>
                        <a href="{{route('sectors.show', ['sector' => $sector->id])}}">{{$sector->name}}</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">Nenhum registro encontrado!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$sectors->links()}}
    </div>
</div> <!-- container -->
@endsection
