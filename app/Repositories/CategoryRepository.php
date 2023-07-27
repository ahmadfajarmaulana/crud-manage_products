<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function getCategoryById($id)
    {
        return Category::with('products')->find($id);
    }

    public function updateCategory($data, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $category;
    }
}
