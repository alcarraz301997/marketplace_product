<?php

namespace App\Dto\Product\Request;

class ProductoUpdateRequestDto
{
    public function __construct(
        public int $id,
        public string $name,
        public float $price,
        public int $stock,
    )
    {}
}
