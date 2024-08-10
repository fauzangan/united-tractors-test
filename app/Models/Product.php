<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'price',
        'image',
    ];

    public function categoryProduct(){
        $this->belongsTo(CategoryProduct::class, 'category_product_id', 'id');
    }

    public function getProducts() {
        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json([
                'message' => 'Product is empty'
            ], 404);
        }

        return response()->json($products);
    }

    public function createProduct($request) {
        $product = Product::create($request);

        return response()->json($product);
    }

    public function getOneProductById($id) {
        $product = Product::where('id', $id)->get();

        if ($product->isEmpty()) {
            return response()->json([
                'message' => 'Product is empty'
            ], 404);
        }

        return response()->json($product);
    }

    public function updateProductById($id, $request) {
        $product = Product::where('id', $id);
        $product->update($request);

        return response()->json($product->get());
    }

    public function deleteProduct($id) {
        Product::destroy($id);
    }

}
