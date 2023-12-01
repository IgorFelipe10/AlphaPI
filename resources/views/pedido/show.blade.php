@extends('layout.carrinho')

@section('main')
<section class="h-100 h-custom" style="background-color: #1C8394">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <h1 class="fw-bold mb-0 text-black">Obrigado pela compra!</h1>
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <br><br><br>
                                        <h2 class="fw-bold mb-0 text-black">Número do pedido: {{$pedido->PEDIDO_ID}}</h2>
                                    </div>
                                    <h6 class="mb-0 text-muted">Data da compra: {{$pedido->PEDIDO_DATA}}</h6>
                                    <hr class="my-4">
                                    <?php
                                        $descontoTotal = 0;
                                        $precoTotalComDesconto = 0;
                                    ?>
                                    @foreach($carrinho as $item)
                                        @if($item->ITEM_QTD > 0)
                                            <?php
                                                $descontoProduto = $item->Produto->PRODUTO_DESCONTO;
                                                $precoProduto = $item->Produto->PRODUTO_PRECO;
                                                $precoProdutoComDesconto = ($precoProduto - $descontoProduto) * $item->ITEM_QTD;
                                                $precoTotalComDesconto += $precoProdutoComDesconto;
                                                $descontoTotal += $descontoProduto * $item->ITEM_QTD;
                                            ?>
                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img src="{{ $item->Produto->ProdutoImagem[0]->IMAGEM_URL }}"
                                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <h6 class="text-black mb-0">{{ $item->Produto->PRODUTO_NOME }}</h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <button class="btn btn-link px-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input id="form1" name="quantity" value="{{ $item->ITEM_QTD }}"
                                                        type="number" class="form-control form-control-sm" disabled/>
                                                    <button class="btn btn-link px-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h6 class="mb-0">R${{ $precoProdutoComDesconto }}</h6>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
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
                                        <h5>R${{ $descontoTotal }}</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total: </h5>
                                        <h5>R${{ $precoTotalComDesconto }}</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <a href="/">
                                            <button type="submit" class="buttonfinalizar">Voltar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
