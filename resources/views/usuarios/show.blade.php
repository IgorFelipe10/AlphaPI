@extends('layout.app')
    @section('main')

    <div class="principal-poy">
    <h1>Dados do Usuário</h1>
    <table class="table">
        <tr>
            <th>Nome de Usuário:</th>
            <td>{{$user->USUARIO_NOME}}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{$user->USUARIO_EMAIL}}</td>
        </tr>
        <tr>
            <th>CPF:</th>
            <td>{{$user->USUARIO_CPF}}</td>
        </tr>
    </table>

    <div class="d-flex justify-content-between mb-4">
        <a href="{{route('usuarios.edit',['user'=>$user->USUARIO_ID])}}" class="editar" role="button">Editar</a>
        <a href="/" class="buttonvolt">Voltar</a>
    </div>
</div>

@endsection