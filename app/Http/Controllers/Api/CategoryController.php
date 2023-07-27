<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();

        return apiResponseSuccess($categories, 'OK');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return apiResponseError(['errors' => [$validator->errors()]], 400);
        }

        $createCategory = $this->categoryRepository->createCategory($request->all());
        return apiResponseCreated($createCategory);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return apiResponseNotFound();
        }

        return apiResponseSuccess($category, 'OK');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return apiResponseError(['errors' => [$validator->errors()]], 400);
        }

        $updateCategory = $this->categoryRepository->updateCategory($request->all(), $id);
        return apiResponseSuccess($updateCategory, 'Data successfully updated');
    }

    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);
        return apiResponseDeleted();
    }
}
