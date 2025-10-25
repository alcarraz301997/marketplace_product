<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateReceiptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Order $order,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $receipt = $this->buildReceipt();

        // Mandar orden a Log
        Log::info("Recibo de pedido {$this->order->id}:\n" . $receipt);

        // Envio de correo
        Log::info("Se envió correo al usuario {$this->order->user_id} para el pedido {$this->order->id}");
    }

    protected function buildReceipt(): string
    {
        $lines = [];
        $lines[] = "Orden #{$this->order->id}";
        $lines[] = "Usuario: {$this->order->user->id} - {$this->order->user->name}";

        foreach ($this->order->products as $p) {
            $lines[] = "{$p->pivot->quantity} x {$p->name} @ {$p->price} = {$p->pivot->subtotal}";
        }

        $lines[] = "TOTAL: {$this->order->total}";

        return implode("\n", $lines);
    }
}
