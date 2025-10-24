<?php

namespace App\Http\Mappers\Product;

use App\Dto\Product\Request\ProductoUpdateRequestDto;
use Illuminate\Http\Request;

class ProductoUpdateMapper
{
    public static function map(Request $request): ProductoUpdateRequestDto
    {
        return new ProductoUpdateRequestDto(
            (int) $request->route('id'),
            $request->input('name'),
            $request->input('price'),
            $request->input('stock'),
        );
    }
}
