<?php

namespace App\Console\Commands;

use App\Enum\StatusEnum;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpirePendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia a expirado las ordenes que sobrepasen las 24horas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = now()->subHours(24);
        $orders = Order::where('status', StatusEnum::PENDING->value)->where('created_at', '<', $threshold)->get();

        foreach ($orders as $order) {
            $order->status = StatusEnum::EXPIRED->value;
            $order->save();

            $this->info("Order {$order->id} expired");

            Log::info('Orden expirada por comando', ['order_id' => $order->id]);
        }

        $this->info("Total expirado: {$orders->count()}");
        return 0;
    }
}
