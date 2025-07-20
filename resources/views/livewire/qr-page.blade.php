<main class="flex flex-col gap-8 w-full max-w-md shadow-lg p-4 rounded-lg bg-white">
    <div class="flex justify-between items-center">
        <h1 class="font-bold text-2xl">Hi {{ Auth::user()->name }}!</h1>
        <a href="/" class="text-blue-500 hover:text-blue-700">Kembali</a>
    </div>
    <div class="flex flex-col items-center gap-0">
        <span class="text-gray-500 text-center text-md">Kode Pembayaran</span>
        <img src="/frame.png" alt="QR Code" class="w-48 h-48">
        <span class="text-sm text-gray-500"> Harap segera lakukan pembayaran sebelum pukul {{ \Carbon\Carbon::parse($station->payment_expiration)->format('H:i') }}</span>
        <div class="w-full mt-4 text-sm text-gray-700">
            <span>Detail Pesanan:</span>
            <div class="flex justify-between items-center">
                <span>Nomor meja / station</span>
                <span>{{ $station->name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span>Durasi</span>
                <span>{{ $station->duration / 60 }} menit</span>
            </div>
            <div class="flex justify-between items-center">
                <span>Total Bayar</span>
                <span class="font-bold">Rp. {{ number_format($station->payment_total, 0, ',', '.') }}</span>
            </div>
        </div>
        <span class="text-sm text-gray-500 italic">"Harap gunakan dengan bijak"</span>
    </div>
    <div class="w-full flex justify-center gap-2">
        <button type="button"
            wire:click="simulatePayment"
            class="cursor-pointer inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
            Simulasi Bayar
        </button>
        <button type="button"
            wire:click="simulateExpire"
            class="cursor-pointer inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
            Simulasi Expire
        </button>
    </div>
</main>
