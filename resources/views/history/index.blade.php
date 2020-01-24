@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Histórico de Empréstimo de Chaves</h2>
        </div>
        <div class="card-body">
            <table id="example" class="table table-hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empréstimo em</th>
                        <th>Porteiro</th>
                        <th>Quem pegou</th>
                        <th>Devoluçao em</th>
                        <th>Quem devolveu</th>
                        <th>Chave</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $t)
                    <tr>
                        {{-- <td>{{dd($t)}}</td> --}}
                        <td>{{$t->id}}</td>
                        <td>{{date('d/m/Y - H:i:s', strtotime($t->tcreated))}}</td>
                        <td>{{$users[$t->gatekeeper_id]}}</td>
                        <td>{{$users[$t->user_id]}}</td>
                        <td>
                            {{date('d/m/Y - H:i:s', strtotime($t->tupdated))}}
                        </td>
                        <td>
                            {{$t->returned_key_user_id ? $users[$t->returned_key_user_id] : ""}}
                        </td>
                        <td>{{$t->name}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">Nenhum registro encontrado!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$transactions->links()}}
        </div>
    </div> <!-- container -->
    @endsection
