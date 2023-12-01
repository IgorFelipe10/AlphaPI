@extends('layout.carrinho')

@section('main')
<section class="" style="background-color: #ffB059;">
    <div class="container py-5 h-100">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-lg-8">
                        <div class="p-5">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black">Carrinho</h1>
                                <h6 class="mb-0 text-muted"></h6>
                            </div>
                            <hr class="my-4">

                            @foreach($carrinho as $item)
    @if($item->ITEM_QTD > 0)
        <div class="item" data-produto-id="{{ $item->Produto->PRODUTO_ID }}">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <img src="{{ $item->Produto->ProdutoImagem[0]->IMAGEM_URL }}" class="img-fluid rounded-3" alt="Cotton T-shirt">
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3">
                <h6 class="text-muted">{{ $item->Produto->PRODUTO_NOME }}</h6>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2" onclick="diminuirQuantidade({{ $item->Produto->PRODUTO_ID }})">
                    <i class="fas fa-minus"></i>
                </button>
                <input id="quantity_{{ $item->Produto->PRODUTO_ID }}" min="1" name="quantity[]" value="{{ $item->ITEM_QTD }}" type="number" class="form-control form-control-sm" onchange="atualizarSubtotal('{{ $item->Produto->PRODUTO_ID }}')" />
                <button class="btn btn-link px-2" onclick="aumentarQuantidade({{ $item->Produto->PRODUTO_ID }})">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                @if($item->ITEM_QTD == 1)
                    <h6 id="preco_{{ $item->Produto->PRODUTO_ID }}" class="preco mb-0" data-preco="{{ $item->Produto->PRODUTO_PRECO }}" data-desconto="{{ $item->Produto->PRODUTO_DESCONTO }}">
                        R${{ $item->Produto->PRODUTO_PRECO }}
                    </h6>
                @else
                    <h6 id="preco_{{ $item->Produto->PRODUTO_ID }}" class="preco mb-0" data-preco="{{ $item->Produto->PRODUTO_PRECO }}" data-desconto="{{ $item->Produto->PRODUTO_DESCONTO }}">
                        R${{ $item->Produto->PRODUTO_PRECO * $item->ITEM_QTD }}
                    </h6>
                @endif
            </div>
            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
            <button class="btn btn-link" data-produto-id="{{ $item->Produto->PRODUTO_ID }}">
    <i class="fas fa-times"></i> Excluir
</button>


            </div>
        </div>
        <hr class="my-4">
    @endif
@endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 bg-grey">
                        <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Resumo</h3>
                            <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                <h5 class="text-uppercase">Desconto: </h5>
                <h5 id="desconto" data-valor="{{ $descontoTotal }}">R${{ $descontoTotal }}</h5>
            </div>
         
                            <hr class="my-4">
                            <h5 class="text-uppercase">Total: </h5>
                            <?php
$precoTotal = 0;
?>
<div id="invisivel">
    @foreach($carrinho as $item)
    @if($item->ITEM_QTD > 0)
    <?php $precoItem = $item->Produto->PRODUTO_PRECO * $item->ITEM_QTD; ?>
    {{ $precoTotal += $precoItem }}
    @endif
    @endforeach
</div>
                            <h5 id="total">R${{ $precoTotal - $descontoTotal }}</h5>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <a href="/">
                                <h4>Voltar</h4>
                            </a>
                        </div>
                        <form action="{{ route('pedido.checkout') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="endereco_id" class="form-label">Escolha seu endereço:</label>
        <select class="form-select" id="endereco_id" name="endereco_id" required>
            @foreach($enderecos as $endereco)
                <option value="{{ $endereco->ENDERECO_ID }}">
                    {{ $endereco->ENDERECO_NOME }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Finalizar Pedido</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script>






    function diminuirQuantidade(produtoId) {
        var quantidadeElement = document.getElementById('quantity_' + produtoId);
        var quantidadeAtual = parseInt(quantidadeElement.value);
        quantidadeElement.value = quantidadeAtual - 1;
        if (quantidadeElement.value < 1) {
            quantidadeElement.value = 1;
        }
        console.log('Diminuir quantidade chamada');
        atualizarSubtotal(produtoId);
        atualizarDesconto();
    }

    function aumentarQuantidade(produtoId) {
        var quantidadeElement = document.getElementById('quantity_' + produtoId);
        var quantidadeAtual = parseInt(quantidadeElement.value);
        quantidadeElement.value = quantidadeAtual + 1;
        console.log('Aumentar quantidade chamada');
        atualizarSubtotal(produtoId);
        atualizarDesconto();
    }

    function excluirProduto(produtoId) {
    console.log('Função excluirProduto chamada para o produto ID:', produtoId);
    var itemElement = document.querySelector('.item[data-produto-id="' + produtoId + '"]');
    itemElement.remove();
    atualizarDesconto();
    atualizarTotal();
}



    function atualizarSubtotal(produtoId) {
    var quantidadeElement = document.getElementById('quantity_' + produtoId);
    var precoElement = document.getElementById('preco_' + produtoId);

    if (!precoElement) {
        console.error('Elemento de preço não encontrado para o produto ID:', produtoId);
        return;
    }

    var precoUnitario = parseFloat(precoElement.dataset.preco);
    var desconto = parseFloat(precoElement.dataset.desconto);
    var quantidade = parseInt(quantidadeElement.value);

    if (isNaN(precoUnitario) || isNaN(desconto) || isNaN(quantidade)) {
        console.error('Dados inválidos para o produto ID:', produtoId);
        return;
    }

    var precoTotal = precoUnitario * quantidade;
    var descontoTotal = desconto * quantidade;
    precoTotal -= descontoTotal;

    console.log('Preço Total:', precoTotal);

    precoElement.innerHTML = 'R$' + precoTotal.toFixed(2);

    atualizarDesconto(); // Atualizar desconto ao mesmo tempo
    atualizarTotal();   // Atualizar total ao mesmo tempo
}

function calcularDescontoInicial() {
            console.log('Calcular desconto inicial chamado');
            var descontoElement = document.getElementById('desconto');
            var descontoTotal = 0;

            var itens = document.querySelectorAll('.item');
            itens.forEach(function (item) {
                var produtoId = item.getAttribute('data-produto-id');
                var quantidadeElement = document.getElementById('quantity_' + produtoId);
                var precoElement = document.getElementById('preco_' + produtoId);

                if (!quantidadeElement || !precoElement) {
                    console.error('Elementos não encontrados para o produto ID:', produtoId);
                    return;
                }

                var quantidade = parseInt(quantidadeElement.value);
                var desconto = parseFloat(precoElement.dataset.desconto);

                if (isNaN(quantidade) || isNaN(desconto)) {
                    console.error('Dados inválidos para o produto ID:', produtoId);
                    return;
                }

                descontoTotal += desconto * quantidade;
            });

            console.log('Desconto Total:', descontoTotal);

            descontoElement.innerHTML = 'R$' + descontoTotal.toFixed(2);
            atualizarTotal();
        }


        function atualizarDesconto() {
    var descontoElement = document.getElementById('desconto');
    var descontoTotal = 0;

    var itens = document.querySelectorAll('.item');
    itens.forEach(function (item) {
        var produtoId = item.getAttribute('data-produto-id');
        var quantidade = parseInt(document.getElementById('quantity_' + produtoId).value);
        var precoElement = document.getElementById('preco_' + produtoId);
        var desconto = parseFloat(precoElement.dataset.desconto);

        descontoTotal += desconto * quantidade;
    });

    descontoElement.innerHTML = 'R$' + descontoTotal.toFixed(2);
    atualizarTotal(); // Atualizar total ao mesmo tempo
}

function atualizarTotal() {
    var totalElement = document.getElementById('total');
    var descontoTotalElement = document.getElementById('desconto');
    var descontoTotal = parseFloat(descontoTotalElement.dataset.valor);
    var total = 0;

    var produtos = document.querySelectorAll('.item');

    produtos.forEach(function (produto) {
        var produtoId = produto.getAttribute('data-produto-id');
        var quantidade = parseInt(document.getElementById('quantity_' + produtoId).value);
        var precoElement = document.getElementById('preco_' + produtoId);
        var precoUnitario = parseFloat(precoElement.dataset.preco);
        var desconto = parseFloat(precoElement.dataset.desconto);

        var precoTotalProduto = precoUnitario * quantidade;
        precoTotalProduto -= desconto * quantidade; 

        total += precoTotalProduto;
    });

    totalElement.innerHTML = 'R$' + total.toFixed(2);
}

    var quantityInputs = document.querySelectorAll('input[name="quantity[]"]');
        quantityInputs.forEach(function (input) {
            input.addEventListener('input', function () {
                var produtoId = input.getAttribute('data-produto-id');
                atualizarSubtotal(produtoId);
            });
        });
    </script>
@endsection