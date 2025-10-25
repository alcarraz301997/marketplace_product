<?php

namespace App\Repositories\Product;

use App\Dto\Product\Request\ProductoCreateRequestDto;
use App\Dto\Product\Request\ProductoUpdateRequestDto;
use App\Dto\Product\Request\ProductSearchRequestDto;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
     * @param integer $id
     * @return Product
     */
    public function show(int $id): Product
    {
        return Product::find($id);
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

    /**
     * @return Collection
     */
    public function topProducts(): Collection
    {
        return Product::select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('SUM(order_product.quantity) as total_sold')
            )
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
    }
}
