<?php

namespace App\Dto\Product\Request;

class ProductoCreateRequestDto
{
    public function __construct(
        public string $name,
        public float $price,
        public int $stock,
    )
    {}
}
