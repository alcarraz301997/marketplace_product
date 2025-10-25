<?php

namespace App\Services\Product;

use App\Dto\Order\Response\ProductOrderResponseDto;
use App\Dto\Product\Request\ProductoCreateRequestDto;
use App\Dto\Product\Request\ProductoUpdateRequestDto;
use App\Dto\Product\Request\ProductSearchRequestDto;
use App\Dto\Product\Response\ProductResponseDto;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
    )
    {}

    /**
     * @param ProductSearchRequestDto $productSearch
     * @return ProductResponseDto[]
     */
    public function index(ProductSearchRequestDto $productSearch): array
    {
        $products = $this->productRepository->index($productSearch);

        return $products->map(function (Product $product) {
            return ProductResponseDto::fromDto($product);
        })->toArray();
    }

    /**
     * @param ProductoCreateRequestDto $productCreate
     * @return ProductResponseDto
     */
    public function store(ProductoCreateRequestDto $productCreate): ProductResponseDto
    {
        $product = $this->productRepository->store($productCreate);

        return ProductResponseDto::fromDto($product);
    }

    /**
     * @param ProductoUpdateRequestDto $productUpdate
     * @return ProductResponseDto
     */
    public function update(ProductoUpdateRequestDto $productUpdate): ProductResponseDto
    {
        $product = $this->productRepository->update($productUpdate);

        return ProductResponseDto::fromDto($product);
    }

    /**
     * @param integer $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->productRepository->destroy($id);
    }

    /**
     * @param ProductoUpdateRequestDto $productUpdate
     * @return ProductOrderResponseDto[]
     */
    public function topProducts(): array
    {
        return $this->productRepository->topProducts()->toArray();
    }
}
