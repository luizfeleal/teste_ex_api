<?php

namespace App\Http\Controllers;

use App\Models\ImagemProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class ImagemProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $imagemProduto = ImagemProdutos::all();

            return response()->json($imagemProduto, 200);
        }catch(Exception $e){
            return response()->json('Houve um erro ao tentar coletar as imagens dos produtos.', 500);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $dados = $request->all();
            $validator = Validator::make($dados, Clientes::rules(), Clientes::feedback());

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $imagemProduto = ImagemProduto::find($id);

            if(!$imagemProduto) {
                return response()->json(["response" => "Imagem não encontrada"], 404);
            }

            return response()->json($cliente, 200);
        } catch(\Exception $e) {
            return response()->json(["response" => "Houve um erro ao tentar coletar a imagem de id: $id.", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $dados = $request->all();

            return DB::transaction(function() use ($dados, $id){
                $imagemProduto = ImagemProdutos::findOrFail($id);

                $imagemProduto->fill($dados);
                $imagemProduto->save();

                return response()->json(['message' => 'Imagem do produto atualizada com sucesso!', 'response' => $imagemProduto], 200);
            });
        }catch(\Exception $e) {
            return response()->json(["response" => "Houve um erro ao tentar atualizar a imagem de id: $id.", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
