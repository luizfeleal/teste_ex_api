<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos_pedido';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'produto_descricao',
        'produto_valor_venda',
        'produto_stoque'
    ];

    public static function rules($id = null)
     {
        return [
            "id_produto" => "required|int",
            "id_cliente"=> "required|int"
        ];
     }

     public static function feedback($id = null)
     {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'unique' => 'O valor informado para o campo :attribute já está em uso.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
        ];
     }
}