<?php

namespace App\Http\Mappers\Order;

use App\Dto\Order\Request\OrderCreateRequestDto;
use Illuminate\Http\Request;

class OrderCreateMapper
{
    public static function map(Request $request): OrderCreateRequestDto
    {
        return new OrderCreateRequestDto(
            $request->input('user_id'),
            $request->input('products'),
        );
    }
}
