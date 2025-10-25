<?php

namespace App\Repositories\Product;

use App\Dto\Product\Request\ProductoCreateRequestDto;
use App\Dto\Product\Request\ProductoUpdateRequestDto;
use App\Dto\Product\Request\ProductSearchRequestDto;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepository
{
    /**
     * @param ProductSearchRequestDto $productSearch
     * @return Collection<Product>
     */
    public function index(ProductSearchRequestDto $productSearch): Collection;

    /**
     * @param integer $id
     * @return Product
     */
    public function show(int $id): Product;

    /**
     * @param ProductoCreateRequestDto $productSearch
     * @return Product
     */
    public function store(ProductoCreateRequestDto $productSearch): Product;

    /**
     * @param ProductoUpdateRequestDto $productSearch
     * @return Product
     */
    public function update(ProductoUpdateRequestDto $productSearch): Product;

    /**
     * @param integer $id
     * @return void
     */
    public function destroy(int $id): void;

    /**
     * @return Collection
     */
    public function topProducts(): Collection;
}
