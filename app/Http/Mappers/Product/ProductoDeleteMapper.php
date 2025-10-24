<?php

namespace App\Http\Mappers\Product;

use Illuminate\Http\Request;

class ProductoDeleteMapper
{
    public static function map(Request $request): int
    {
        return (int) $request->route('id');
    }
}
