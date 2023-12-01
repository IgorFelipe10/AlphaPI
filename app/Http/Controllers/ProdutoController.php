<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index(){
      $search= request('search');
      if($search){
          $produtos=Produto::where([
              ['PRODUTO_NOME','like','%'.$search.'%']
          ])->get();
      }else{
          $produtos = Produto::all();
      }



    return view('produto.index',['produtos'=>$produtos,'search'=>$search]);
    }

    public function show(Produto $produto){ 
   $maisProdutos = Categoria::find($produto->CATEGORIA_ID)->Produtos;
      return view ('produto.show', ['produto' =>$produto,'maisProdutos' => $maisProdutos]);

    }

}
