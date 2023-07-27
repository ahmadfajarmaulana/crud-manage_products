<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAllProducts()
    {
        $products = Product::with('category')->get();
        return $products;
    }

    public function createProduct($data)
    {
        $product = Product::create($data);
        return $product;
    }

    public function getProductById($id)
    {
        return Product::with('category')->find($id);
    }

    public function updateProduct($data, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product->fresh();
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return $product;
    }
}
