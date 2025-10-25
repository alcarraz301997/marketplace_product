<?php

namespace App\Repositories\Order;

use App\Enum\StatusEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;

interface OrderRepository
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @return Collection
     */
    public function orderByUser(): Collection;

    /**
     * @param integer $userId
     * @param StatusEnum $status
     * @return Order
     */
    public function store(int $userId, float $total, StatusEnum $status): Order;
}
