<div>
    <main class="flex flex-col gap-8 max-w-[335px] w-full lg:max-w-4xl">
        <div class="flex flex-col gap-0 items-center">
            <h1 class="font-bold text-2xl">Selamat Datang di Luki Station!</h1>
            <h3 class="text-lg italic">Automatic charging station for everyone</h3>
        </div>
        <div class="w-full flex flex-col items-center gap-2">
            <div class="w-full max-w-xs mx-auto">
                <label>Username</label>
                <input type="text"
                    name="username"
                    wire:model="username"
                    autofocus
                    placeholder="Name"
                    @keyup.enter="$wire.login()"
                    class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                />
            </div>
            <button type="button"
                wire:click="login"
                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                Masuk
            </button>
        </div>
    </main>
</div>
