<?php

namespace App\Http\Mappers\Product;

use App\Dto\Product\Request\ProductoCreateRequestDto;
use Illuminate\Http\Request;

class ProductoCreateMapper
{
    public static function map(Request $request): ProductoCreateRequestDto
    {
        return new ProductoCreateRequestDto(
            $request->input('name'),
            $request->input('price'),
            $request->input('stock'),
        );
    }
}
