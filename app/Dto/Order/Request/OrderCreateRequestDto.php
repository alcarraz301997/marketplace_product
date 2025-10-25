<?php

namespace App\Dto\Order\Request;

class OrderCreateRequestDto
{
    public function __construct(
        public int $userId,
        public array $products,
    )
    {}
}
