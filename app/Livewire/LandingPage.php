<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class LandingPage extends Component
{
    public string $username = '';

    public function login()
    {
        $user = User::query()
            ->firstWhere('name', $this->username);
        if (!$user) {
            $user = User::create([
                'name' => $this->username,
                'password' => Hash::make('password')
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }

    #[Title("Welcome to Luki Station")]
    public function render()
    {
        return view('livewire.landing-page');
    }
}
