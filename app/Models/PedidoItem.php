<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;
    protected $table = 'PEDIDO_ITEM';

    protected $fillable = [
        'PRODUTO_ID',
        'PEDIDO_ID',
        'ITEM_QTD',
        'ITEM_PRECO'
    ];
        
    public $timestamps = false;


    public function produto()
{
    return $this->belongsTo(Produto::class, 'PRODUTO_ID');
}

    protected function setKeysForSaveQuery($query)
    {
        $query->where('PRODUTO_ID', $this->getAttribute('PRODUTO_ID'));
        return $query;
    }
    
    public function PedidoItem(){
        $statusItem= $this->hasMany(PedidoItem::class, 'PEDIDO_ID', 'PEDIDO_ID');
        return $statusItem;
    }


}
