<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAllProducts();
        return apiResponseSuccess($products, 'OK');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'description' => 'nullable',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return apiResponseError(['errors' => [$validator->errors()]], 400);
        }

        $createProduct = $this->productRepository->createProduct($request->all());
        return apiResponseCreated($createProduct);
    }

    public function show($id)
    {
        $product = $this->productRepository->getProductById($id);

        if (!$product) {
            return apiResponseNotFound();
        }

        return apiResponseSuccess($product, 'OK');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $id,
            'category_id' => 'required',
            'description' => 'nullable',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return apiResponseError(['errors' => [$validator->errors()]], 400);
        }

        $updateProduct = $this->productRepository->updateProduct($request->all(), $id);
        return apiResponseSuccess($updateProduct, 'Data successfully updated');
    }

    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);
        return apiResponseDeleted();
    }
}
