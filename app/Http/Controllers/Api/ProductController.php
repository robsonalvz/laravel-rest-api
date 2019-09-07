<?php

namespace App\Http\Controllers\Api;
use App\Product;
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
        $productData = $request->all();
        $this->product->create($productData);
    }
}
