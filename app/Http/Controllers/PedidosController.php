<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class PedidosController extends Controller
{
    
    public function index()
    {
        try{
            $pedidos = Pedidos::all();

            return response()->json($pedidos, 200);
        }catch(Exception $e){
            return response()->json('Houve um erro ao tentar coletar os pedidos.', 500);
        }
    }



    
    public function store(Request $request)
    {
        try {
            $dados = $request->all();
            $validator = Validator::make($dados, Pedidos::rules(), Pedidos::feedback());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            return DB::transaction(function () use ($dados) {
                $clientes = new Clientes();
                $clientes->fill($dados);
                $clientes->save();
                return response()->json(['message' => 'Cliente cadastrado com sucesso!', 'response' => $clientes], 201);
            });

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Erro de validação: ' . $e->getMessage()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'Houve um erro ao tentar cadastrar o cliente.'], 500);
        }
    }

    
    public function show($id)
    {
        try {
            $pedido = Pedidos::find($id);

            if(!$pedido) {
                return response()->json(["response" => "Pedido não encontrado"], 404);
            }

            return response()->json($pedido, 200);
        } catch(\Exception $e) {
            return response()->json(["response" => "Houve um erro ao tentar coletar o pedido de id: $id.", "error" => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try{

            $dados = $request->all();

            return DB::transaction(function() use ($dados, $id){
                $pedido = Clientes::findOrFail($id);

                $pedido->fill($dados);
                $pedido->save();

                return response()->json(['message' => 'Pedido atualizado com sucesso!', 'response' => $pedido], 200);
            });
        }catch(\Exception $e) {
            return response()->json(["response" => "Houve um erro ao tentar atualizar o pedido de id: $id.", "error" => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        //
    }
}
