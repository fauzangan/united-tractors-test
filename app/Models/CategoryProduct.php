<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'product_category_id', 'id');
    }

    public function getCategoryProducts() {
        $categoryProducts = CategoryProduct::all();

        if ($categoryProducts->isEmpty()) {
            return response()->json([
                'message' => 'Category Product is empty'
            ], 404);
        }

        return response()->json($categoryProducts);
    }

    public function createCategoryProduct($request) {
        $categoryProducts = CategoryProduct::create([
            'name' => $request['name']
        ]);

        return response()->json($categoryProducts);
    }

    public function getOneById($id) {
        $categoryProduct = CategoryProduct::where('id', $id)->get();

        if ($categoryProduct->isEmpty()) {
            return response()->json([
                'message' => 'Category Product is empty'
            ], 404);
        }

        return response()->json($categoryProduct);
    }

    public function updateCategoryById($id, $request){
        $categoryProduct = CategoryProduct::where('id', $id);
        $categoryProduct->update($request);

        return response()->json($categoryProduct->get());
    }

    public function deleteCategoryProduct($id) {
        CategoryProduct::destroy($id);
    }
}
