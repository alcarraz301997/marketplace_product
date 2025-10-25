<?php

namespace App\Services\Order;

use App\Dto\Order\Request\OrderCreateRequestDto;
use App\Dto\Order\Response\OrderResponseDto;
use App\Enum\StatusEnum;
use App\Jobs\GenerateReceiptJob;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private ProductRepository $productRepository,
    )
    {}

    /**
     * @return OrderResponseDto[]
     */
    public function index(): array
    {
        $orders = $this->orderRepository->index();

        return $orders->map(function (Order $order) {
            return OrderResponseDto::fromDto($order);
        })->toArray();
    }

    /**
     * @return OrderResponseDto[]
     */
    public function orderByUser(): array
    {
        $orders = $this->orderRepository->orderByUser();

        return $orders->map(function (Order $order) {
            return OrderResponseDto::fromDto($order);
        })->toArray();
    }

    /**
     * @param OrderCreateRequestDto $orderCreate
     * @return OrderResponseDto
     */
    public function store(OrderCreateRequestDto $orderCreate): OrderResponseDto
    {
        // Se crea la orden
        $order = $this->orderRepository->store($orderCreate->userId, 0, StatusEnum::PENDING);

        $total = 0;
        foreach ($orderCreate->products as $productOrder) {
            $product = $this->productRepository->show($productOrder['id']);

            if ($product->stock < $productOrder['quantity']) {
                throw new \Exception("El producto {$product->name} no tiene suficiente stock.");
            }

            // Se calcula el subtotal
            $subtotal = $product->price * $productOrder['quantity'];

            // Se actualiza el stock
            $product->stock = $product->stock - $productOrder['quantity'];
            $product->save();

            $order->products()->attach($product->id, [
                'quantity' => $productOrder['quantity'],
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->total = $total;
        $order->save();

        // Se manda a Log la orden creada
        Log::info('Orden creada N°' . $order->id, [
                'order_id' => $order->id,
                'user_id' => $orderCreate->userId,
                'total' => $order->total,
            ]);

        // Se manda a cola la generacion del recibo
        GenerateReceiptJob::dispatch($order)->afterCommit();

        return OrderResponseDto::fromDto($order->load(['products']));
    }
}
