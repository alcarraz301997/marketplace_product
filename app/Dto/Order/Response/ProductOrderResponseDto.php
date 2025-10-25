<?php

namespace App\Dto\Order\Response;

use App\Models\Product;
use Illuminate\Support\Fluent;

class ProductOrderResponseDto extends Fluent
{
    public static function fromDto(Product $product): self
    {
        return new self([
            'id'        => $product->id,
            'name'      => $product->name,
            'price'     => $product->price,
            'stock'     => $product->stock,
            'quantity'  => $product->pivot->quantity,
            'subtotal'  => $product->pivot->subtotal,
        ]);
    }
}
