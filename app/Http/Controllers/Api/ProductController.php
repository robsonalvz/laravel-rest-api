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
}
