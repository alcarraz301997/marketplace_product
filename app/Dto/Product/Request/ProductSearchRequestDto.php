<?php

namespace App\Dto\Product\Request;

class ProductSearchRequestDto
{
    public function __construct(
        public ?int $minPrice = null,
        public ?int $maxPrice = null,
        public string $orderBy = 'asc',
    )
    {}
}
