<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $table ='ENDERECO'; 
    protected $primaryKey ='ENDERECO_ID';

    public $timestamps = false;

    protected $fillable = [
        'USUARIO_ID',
        'ENDERECO_NOME',
        'ENDERECO_LOGRADOURO',
        'ENDERECO_NUMERO',
        'ENDERECO_COMPLEMENTO',
        'ENDERECO_CEP',
        'ENDERECO_CIDADE',
        'ENDERECO_ESTADO'
    ];
    public function usuarioEnderecos(){
        return $this->hasMany(Endereco::class, 'USUARIO_ID', 'USUARIO_ID');
    }
    
}
