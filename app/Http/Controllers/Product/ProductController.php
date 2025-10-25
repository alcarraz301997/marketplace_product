<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Mappers\Product\ProductoCreateMapper;
use App\Http\Mappers\Product\ProductoDeleteMapper;
use App\Http\Mappers\Product\ProductoUpdateMapper;
use App\Http\Mappers\Product\ProductSearchMapper;
use App\Http\Requests\Product\StoreProductRequest;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
    )
    {}

    public function index(Request $request): JsonResponse
    {
        try {
            $mapper = ProductSearchMapper::map($request);
            $products = $this->productService->index($mapper);

            return $this->response('OK', $products);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $mapper = ProductoCreateMapper::map($request);
            $product = $this->productService->store($mapper);

            DB::commit();
            return $this->response('Se registro el producto.', $product);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function update(StoreProductRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $mapper = ProductoUpdateMapper::map($request);
            $product = $this->productService->update($mapper);

            DB::commit();
            return $this->response('Se actualizo el producto.', $product);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function destroy(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $mapper = ProductoDeleteMapper::map($request);
            $this->productService->destroy($mapper);

            DB::commit();
            return $this->response('Se elimino el producto seleccionado.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function topProducts(): JsonResponse
    {
        try {
            $products = $this->productService->topProducts();

            return $this->response('Top 5 productos vendidos.', $products);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
