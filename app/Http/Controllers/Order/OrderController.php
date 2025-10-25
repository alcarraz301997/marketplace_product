<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Mappers\Order\OrderCreateMapper;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\User;
use App\Services\Order\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
    )
    {}

    public function index(): JsonResponse
    {
        try {
            $order = $this->orderService->index();
            return $this->response('OK', $order);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function orderByUser(): JsonResponse
    {
        try {
            $order = $this->orderService->orderByUser();

            return $this->response('OK', $order);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $mapper = OrderCreateMapper::map($request);
            $order = $this->orderService->store($mapper);

            DB::commit();
            return $this->response('Se genero la orden', $order);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }
}
