<?php

namespace App\Dto\Order\Response;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Fluent;

class OrderResponseDto extends Fluent
{
    public static function fromDto(Order $order): self
    {
        return new self([
            'id'        => $order->id,
            'user_id'   => $order->user_id,
            'total'     => $order->total,
            'status'    => $order->status,
            'products'  => $order->products->map(function (Product $product) {
                    return ProductOrderResponseDto::fromDto($product);
                })->toArray()

        ]);
    }
}