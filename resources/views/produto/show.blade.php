

@extends('layout.prod')
@section('main')
<script>
    function login() {
        window.alert('Você precisa estar logado!');
    }
    
    </script>
    <main>
        <div class="content">
            <div class="left-side">
                <h1>{{$produto->PRODUTO_NOME}}</h1>
                
                <div class="right-side">
                    <div class="img"> <img src="{{$produto->ProdutoImagem[0]->IMAGEM_URL}}"></div>
                </div>
                
                <p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{$produto->PRODUTO_DESC}}</li>
                        <li class="list-group-item">{{$produto->Categoria->CATEGORIA_NOME}}</li>
                    </ul>
                </p>
                <div style=" display: flex; flex-direction: column">
                    <span>Quantidade disponivel:{{$produto->PRODUTO_QTD}}</span>
                    <span>Valor original:R${{$produto->PRODUTO_PRECO}} </span>
                    <span>Desconto:R${{$produto->PRODUTO_DESCONTO}}</span><br>
                    <span>Valor do produto com desconto: R${{$produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO}}</span><br><br><br>
                </div>
                @if(!Auth::check())
<div>
    <div>
        <label for="">Adicionar quantidade</label>
        <input type="number" name="ITEM_QTD" min="1" value="1">
    </div>
    
    <a href="/login">
        <button type="submit" class="buttonLogin" onclick="login()">Adicionar ao carrinho</button>
    </a>
    
    
    @else
    <form method="POST" action="{{route('carrinho.store', $produto->PRODUTO_ID)}}">
        @csrf
        
        <div>
            <label for="">Adicionar quantidade</label>
            <input type="number" name="ITEM_QTD" min="1" value="1" class="inputCarrinhoQtd"style="border: 1px solid #ffB059; text-align:center; margin-left: 10%; margin-top:-50%">
            
            <button type="submit" class="buttonLogin" onclick="aviso()" style="max-width: 20%">Adicionar ao carrinho</button>
        </div>
</div>
        
                </form>
                @endif


            </div>

        </div>
    </main>
@endsection
