@extends('layout.app')
@section('main')

@if(session()->has('message'))
    {{session()->get('message')}}
@endif

<div class="principal-typ">
    <form action="{{route('usuarios.update',['user'=>$user->USUARIO_ID])}}" method="post">

        @csrf

        <h1>Editar Usuário</h1>

        <input type="hidden" name="_method" value="PUT">

        <table class="table">
            <tr>
                <td>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="USUARIO_NOME" value="{{$user->USUARIO_NOME}}" required>
                        <small id="emailHelp" class="form-text text-muted" ></small>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" id="exampleInputPassword1" name="USUARIO_EMAIL" value="{{$user->USUARIO_EMAIL}}" required>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" id="editar" class="btn btn-primary btn-lg fs-6">Editar</button>
                </td>
                <td>
                    <a href="/" id="voltar" class="buttonvolt">Voltar</a>
                </td>
            </tr>
        </table>

    </form>
</div>

@endsection
