<?php

namespace App\Repositories\Order;

use App\Enum\StatusEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderRepositoryMySql implements OrderRepository
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Order::all()->load('products');
    }

    /**
     * @return Collection
     */
    public function orderByUser(): Collection
    {
        $user = Auth::user();

        return $user->orders()
            ->with(['products:id,name,price,stock'])
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * @param integer $userId
     * @param StatusEnum $status
     * @return Order
     */
    public function store(int $userId, float $total, StatusEnum $status): Order
    {
        return Order::create([
            'user_id' => $userId,
            'total' => $total,
            'status' => $status->value,
        ]);
    }
}
