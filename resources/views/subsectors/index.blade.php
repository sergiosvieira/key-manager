@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <a href="{{route('subsectors.create')}}" class="btn btn-info">Adicionar novo</a>
        <div class="card-header">
            <h2>Lista de Subsetores</h2>
        </div>
        <div class="card-body">
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome do Subsetor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subsectors as $subsector)
                    <tr>
                        <td>{{$subsector->id}}</td>
                        <td>
                            <a
                                href="{{route('subsectors.show', ['subsector' => $subsector->id])}}">{{$subsector->name}}</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">Nenhum registro encontrado!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$subsectors->links()}}
        </div>
    </div> <!-- container -->
    @endsection
