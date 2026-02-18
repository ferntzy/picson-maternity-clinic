<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Http\RedirectResponse;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        // Customize this - examples:

        // Option A: Redirect to a named route (e.g. your public homepage)
        return redirect()->route('welcome');   // define 'welcome' in routes/web.php

        // Option B: Redirect to root or custom path
        // return redirect('/');

        // Option C: Redirect to a frontend login or external site
        // return redirect('https://your-public-site.com');

        // Option D: Conditional based on role / panel (if needed)
        // $user = $request->user();
        // if ($user?->role === 'patient') {
        //     return redirect()->route('patient.home');
        // }
        // return redirect()->route('home');
    }
}
