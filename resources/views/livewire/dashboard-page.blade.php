<main class="flex flex-col gap-8 w-full max-w-md shadow-lg p-4 rounded-lg bg-white">
    <div class="flex justify-between items-center">
        <h1 class="font-bold text-2xl">Hi {{ Auth::user()->name }}!</h1>
        <a href="{{ route('logout') }}" class="text-red-500 hover:text-red-700">Logout</a>
    </div>
    <livewire:component.table-selection :selectedTable="$stationSession?->id" :selectedDuration="$stationSession?->current_session_id" />
</main>
