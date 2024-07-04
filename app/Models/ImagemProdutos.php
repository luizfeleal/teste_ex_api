<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemProdutos extends Model
{
    protected $table = 'imagem_produtos';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_produto',
        'imagem'
    ];

    public static function rules($id = null)
     {
        return [
            "id_produto" => "required|int",
            "imagem"=> "required|string"
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
