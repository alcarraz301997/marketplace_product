<?php

namespace App\Http\Mappers\Product;

use App\Dto\Product\Request\ProductSearchRequestDto;
use Illuminate\Http\Request;

class ProductSearchMapper
{
    public static function map(Request $request): ProductSearchRequestDto
    {
        return new ProductSearchRequestDto(
            $request->input('min_price', null),
            $request->input('max_price', null),
            $request->input('order_by', 'ASC'),
        );
    }
}
