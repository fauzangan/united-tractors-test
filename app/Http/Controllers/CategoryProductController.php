<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/category-products",
     *     summary="Get all category products",
     *     tags={"Category Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of category products"
     *     )
     * )
     */
    public function getCategoryProducts(){
        $categoryProducts = new CategoryProduct();
        return $categoryProducts->getCategoryProducts();
    }

    /**
     * @OA\Post(
     *     path="/api/category-products",
     *     summary="Create a new category product",
     *     tags={"Category Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="Electronics")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category product created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function createCategoryProduct(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $categoryProducts = new CategoryProduct();
        
        return $categoryProducts->createCategoryProduct($validated); 
    }

    /**
     * @OA\Get(
     *     path="/api/category-products/{id}",
     *     summary="Get category product by ID",
     *     tags={"Category Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category product details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category product not found"
     *     )
     * )
     */
    public function getOneCategoryProduct($id){
        $categoryProduct = new CategoryProduct();

        return $categoryProduct->getOneById($id);
    }

    /**
     * @OA\Put(
     *     path="/api/category-products/{id}",
     *     summary="Update category product by ID",
     *     tags={"Category Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="New Category Name")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category product updated successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category product not found"
     *     )
     * )
     */
    public function updateCategoryProductById($id, Request $request){
        $validated = $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $categoryProduct = new CategoryProduct();

        return $categoryProduct->updateCategoryById($id, $validated);
    }

    /**
     * @OA\Delete(
     *     path="/api/category-products/{id}",
     *     summary="Delete category product by ID",
     *     tags={"Category Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category product deleted successfully",
     *         @OA\JsonContent(type="application/json")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category product not found",
     *         @OA\JsonContent(type="application/json")
     *     )
     * )
     */
    public function deleteCategoryProduct($id){
        $categoryProduct = new CategoryProduct();
        $categoryProduct->deleteCategoryProduct($id);

        return response("Success Delete Category Product");
    }
}
