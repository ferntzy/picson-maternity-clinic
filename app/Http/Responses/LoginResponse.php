<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as BaseLoginResponse; // correct v4 contract
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements BaseLoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->to(Filament::getPanel('auth')->getUrl());
        }

        $role = strtolower(trim($user->role ?? ''));

        return match ($role) {
            'admin'             => redirect()->to(Filament::getPanel('admin')->getUrl()),
            'director'          => redirect()->to(Filament::getPanel('director')->getUrl()),
            'doctor'            => redirect()->to(Filament::getPanel('doctor')->getUrl()),
            'nurse'             => redirect()->to(Filament::getPanel('nurse')->getUrl()),
            'patient'           => redirect()->to(Filament::getPanel('patient')->getUrl()),
            default             => redirect()->to(Filament::getPanel('auth')->getUrl()),
        };
    }
}
