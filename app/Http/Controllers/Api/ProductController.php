<?php

namespace App\Http\Controllers\Api;
use App\Product;
use App\API\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }
    public function index(){
        $data = ['data', $this->product->all()];
        return response()->json($data);
    }
    public function show(Product $id){
        return $id;
    }
    public function store(Request $request){
        try{
            $productData = $request->all();
            $this->product->create($productData);
            $return = ['data'=>['msg' =>'Produto criado com sucesso']];
            return response()->json($return,201);
        } catch(\Exception $e){
            if (config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação',1010));
        }
    }
    public function update(Request $request, $id){
        try{
            $productData = $request->all();
            $product = $this->product->find($id);
            $product->update($productData);
            $return = ['data'=>['msg' =>'Produto atualizado com sucesso']];
            return response()->json($return,201);
        } catch(\Exception $e){
            if (config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1011));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação de atualizar',1011));
        }
    }

    public function delete(Product $id){
        try{
            $id->delete();
            return response()->json(['data'=>['msg'=>'Produto: ' . $id->name . ' removido com sucesso!'],200]);
        }catch(\Exception $e){
            if (config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1012));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação de deletar',1012));
        }
    }
}
