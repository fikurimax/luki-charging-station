<div class="w-full flex flex-col gap-2"
    x-data="{
        duration: 1,
        selectTable(id) {
            $wire.selectTable(id, this.duration);
        }
    }"
    wire:poll.5s
>
    @foreach($stations as $station)
        <div
            @class([
                'w-full flex flex-col gap-2 border rounded-lg p-2 border-gray-300 hover:scale-105 transition-transform duration-300',
                'opacity-50' => ($station->payment_token !== null && $station->is_used) && $station->user_id !== auth()->id(),
                'border-green-500 bg-green-50' => ($station->payment_token !== null && $station->is_used) && $station->user_id == auth()->id(),
            ])
        >
            <div class="w-full flex justify-between items-center">
                <div class="flex flex-col gap-1">
                    <span class="font-bold">{{ $station->name }}</span>
                    @if($station->payment_token !== null && $station->is_used)
                        <span class="text-sm text-gray-500 font-medium">Sedang Digunakan</span>
                    @elseif($station->payment_token !== null && !$station->is_used)
                        <span class="text-sm text-gray-500 font-medium">Sedang Dibooking</span>
                    @else
                        <span class="text-sm text-gray-500 font-medium">Tersedia</span>
                    @endif
                </div>
                <div class="flex gap-2 items-center">
                    <select
                        class="border h-6 w-fit text-xs rounded-md"
                        @disabled($station->payment_token !== null || $station->is_used)
                        x-model="duration"
                    >
                        @foreach($durations as $duration)
                            <option value="{{ $duration->id }}"
                                class="text-xs"
                            >
                                {{ $duration->name }} (Rp. {{ number_format($duration->price, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @if($station->user_id == Auth::id() && $station->is_used)
                        <button type="button"
                            wire:click="endSession({{ $station->id }})"
                            wire:confirm="Apakah Anda yakin ingin mengakhiri sesi ini?"
                            class="cursor-pointer inline-flex items-center justify-center px-4 py-1 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-red-500 hover:bg-red-600 border border-red-900 focus:ring-2 focus:ring-offset-2 focus:ring-red-900 focus:shadow-outline focus:outline-none"
                        >
                            Akhiri
                        </button>
                    @elseif($station->user_id == Auth::id() && !$station->is_used && $station->payment_token !== null)
                        <button type="button"
                            wire:click="continuePayment({{ $station->id }})"
                            class="cursor-pointer inline-flex items-center justify-center px-4 py-1 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-orange-500 hover:bg-orange-600 border border-red-900 focus:ring-2 focus:ring-offset-2 focus:ring-red-900 focus:shadow-outline focus:outline-none"
                        >
                            Bayar
                        </button>
                    @else
                        <button type="button"
                            x-on:click="selectTable({{ $station->id }})"
                            @class([
                                "inline-flex items-center justify-center px-4 py-1 text-sm font-medium tracking-wide hover:text-white transition-colors duration-200 rounded-md bg-transparent hover:bg-neutral-900 border border-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none",
                                "cursor-not-allowed" => $station->payment_token !== null || $station->is_used,
                                "cursor-pointer" => !$station->payment_token && !$station->is_used
                            ])
                            @disabled($station->payment_token !== null || $station->is_used)
                        >
                            Pilih
                        </button>
                    @endif
                </div>
            </div>
            @if($station->user_id == Auth::id() && $station->is_used)
                <div class="flex flex-col gap-1 items-center justify-between">
                    <div class="w-full flex justify-between text-xs font-medium text-neutral-900">
                        <span>Digunakan Oleh:</span>
                        <span>{{ $station->user->name }}</span>
                    </div>
                    <div class="w-full flex justify-between text-xs font-medium text-neutral-900">
                        <span>Durasi:</span>
                        <span>{{ $station->duration / 60 }} menit</span>
                    </div>
                    <div class="w-full flex justify-between text-xs font-medium text-neutral-900">
                        <span>Timer:</span>
                        <span>{{ $station->timer }}</span>
                    </div>
                    <div class="w-full flex justify-between text-xs font-medium text-neutral-900">
                        <span>Dimulai:</span>
                        <span>{{ $station->started_at }}</span>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
