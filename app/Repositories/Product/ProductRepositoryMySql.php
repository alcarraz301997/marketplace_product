<?php

namespace App\Repositories\Product;

use App\Dto\Product\Request\ProductoCreateRequestDto;
use App\Dto\Product\Request\ProductoUpdateRequestDto;
use App\Dto\Product\Request\ProductSearchRequestDto;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepositoryMySql implements ProductRepository
{
    /**
     * @param ProductSearchRequestDto $productSearch
     * @return Collection<Product>
     */
    public function index(ProductSearchRequestDto $productSearch): Collection
    {
        $products = Product::query();

        if (isset($productSearch->minPrice)) {
            $products->where('price', '>=', $productSearch->minPrice);
        }

        if (isset($productSearch->maxPrice)) {
            $products->where('price', '<=', $productSearch->maxPrice);
        }

        // Ordenar por stock asc o desc
        if (isset($productSearch->orderBy)) {
            $products->orderBy('stock', $productSearch->orderBy);
        }


        return $products->get();
    }

    /**
     * @param ProductoCreateRequestDto $productSearch
     * @return Product
     */
    public function store(ProductoCreateRequestDto $productCreate): Product
    {
        $product = Product::create([
            'name' => $productCreate->name,
            'price' => $productCreate->price,
            'stock' => $productCreate->stock,
        ]);

        return $product;
    }

    /**
     * @param ProductoUpdateRequestDto $productUpdate
     * @return Product
     */
    public function update(ProductoUpdateRequestDto $productUpdate): Product
    {
        $product = Product::where('id', $productUpdate->id)->update([
            'name' => $productUpdate->name,
            'price' => $productUpdate->price,
            'stock' => $productUpdate->stock,
        ]);

        return Product::findOrFail($productUpdate->id);
    }

    /**
     * @param integer $id
     * @return void
     */
    public function destroy(int $id): void
    {
        Product::destroy($id);
    }
}
