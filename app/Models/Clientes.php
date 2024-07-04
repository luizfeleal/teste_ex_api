<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CLientes extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'cliente_razao_social',
        'cliente_cnpj',
        'cliente_email'
    ];

    public static function rules($id = null)
     {
        return [
            "cliente_razao_social"=> "required|string|max:50",
            "cliente_cnpj"=> "required|string|max:50",
            "cliente_email"=> "required|string|max:50"
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
