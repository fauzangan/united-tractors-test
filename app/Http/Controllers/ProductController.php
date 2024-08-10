<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get All Products",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of Products",
     *         @OA\JsonContent(type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="product_category_id", type="integer", example=2),
     *                 @OA\Property(property="name", type="string", example="Product Name"),
     *                 @OA\Property(property="price", type="number", format="float", example=99.99),
     *                 @OA\Property(property="image", type="string", example="image.jpg")
     *             )
     *         )
     *     )
     * )
     */
    public function getProducts() {
        $products = new Product();

        return $products->getProducts();
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Create a New Product",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_category_id", "name", "price", "image"},
     *             @OA\Property(property="product_category_id", type="integer", example=2),
     *             @OA\Property(property="name", type="string", example="Product Name"),
     *             @OA\Property(property="price", type="number", format="float", example=99.99),
     *             @OA\Property(property="image", type="string", example="image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product successfully created",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="product_category_id", type="integer", example=2),
     *             @OA\Property(property="name", type="string", example="Product Name"),
     *             @OA\Property(property="price", type="number", format="float", example=99.99),
     *             @OA\Property(property="image", type="string", example="image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function createProduct(Request $request){
        $validated = $request->validate([
            'product_category_id' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'image' => ['required']
        ]);

        $product = new Product();

        return $product->createProduct($validated);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Get a Product by ID",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product data",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="product_category_id", type="integer", example=2),
     *             @OA\Property(property="name", type="string", example="Product Name"),
     *             @OA\Property(property="price", type="number", format="float", example=99.99),
     *             @OA\Property(property="image", type="string", example="image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function getOneProductById($id) {
        $product = new Product();

        return $product->getOneProductById($id);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Update a Product by ID",
     *     tags={"Product"},
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
     *             required={"product_category_id", "name", "price", "image"},
     *             @OA\Property(property="product_category_id", type="integer", example=2),
     *             @OA\Property(property="name", type="string", example="Updated Product Name"),
     *             @OA\Property(property="price", type="number", format="float", example=119.99),
     *             @OA\Property(property="image", type="string", example="updated_image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product successfully updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="product_category_id", type="integer", example=2),
     *             @OA\Property(property="name", type="string", example="Updated Product Name"),
     *             @OA\Property(property="price", type="number", format="float", example=119.99),
     *             @OA\Property(property="image", type="string", example="updated_image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function updateProduct($id, Request $request){
        $validated = $request->validate([
            'product_category_id' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'image' => ['required']
        ]);

        $product = new Product();

        return $product->updateProductById($id, $validated);
    }


    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Delete a Product by ID",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function deleteProductById($id){
        $product = new Product();
        $product->deleteProduct($id);
        return response("Product berhasil dihapus");
    }
}
