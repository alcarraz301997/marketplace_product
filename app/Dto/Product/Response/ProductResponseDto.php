<?php

namespace App\Dto\Product\Response;

use App\Models\Product;
use Illuminate\Support\Fluent;

class ProductResponseDto extends Fluent
{
    public static function fromDto(Product $product): self
    {
        return new self([
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
        ]);
    }
}
