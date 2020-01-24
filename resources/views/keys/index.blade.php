@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <a href="{{route('keys.create')}}" class="btn btn-info">Adicionar nova</a>
        <div class="card-header">
            <h2>Lista de Chaves</h2>
        </div>
        <div class="card-body">
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Setor</th>
                        <th>Subsetor</th>
                        <th>Identificação da Chave</th>
                        <th>Disponível?</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($keys as $key)
                    <tr>
                        <td>{{$key->id}}</td>
                        <td>{{$sectors[$sector_sub_sectors->find($key->sector_sub_sector_id)->sector_id]}}</td>
                        <td>{{$sub_sectors[$sector_sub_sectors->find($key->sector_sub_sector_id)->sub_sector_id]}}</td>
                        {{-- <td>{{$sectors[$sector_sub_sectors[$key->sub_sector_id]->sector_id]}}</td>
                        <td>{{$sub_sectors[$sector_sub_sectors[$key->sub_sector_id]->sub_sector_id]}}</td> --}}
                        <td>
                            <a href="{{route('keys.show', ['key' => $key->id])}}">{{$key->name}}</a>
                        </td>
                        <td>{{$key->available ? "Sim" : "Não"}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">Nenhum registro encontrado!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$keys->links()}}
        </div>
    </div> <!-- container -->
    @endsection
