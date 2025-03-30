<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pendiente)
            <button class="underline text-blue-500 hover:no-underline" wire:click="markAsProcessing({{ $order->id }})">
                Alistar producto
            </button>
            @break
        @case(\App\Enums\OrderStatus::Alistando)
            <button class="underline text-blue-500 hover:no-underline">
                Enviar producto
            </button>
            @break
        @default
            
    @endswitch
    <button class="underline text-red-500 hover:no-underline">
        Cancelar
    </button>
</div>