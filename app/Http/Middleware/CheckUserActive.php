<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Chanthoeun\FilamentCustomForms\CustomFormPlugin;

class CheckUserActive
{
    public function handle(Request $request, Closure $next)
    {
        try {
            if (class_exists(CustomFormPlugin::class)) {
                CustomFormPlugin::get()->navigationGroup(__('navigation.groups.form_builder'));
            }
        } catch (\Throwable $e) {
            // Silence
        }

        if (Auth::check() && Auth::user()?->is_active === false) {
            Notification::make()
                ->title(__('auth.account_disabled'))
                ->danger()
                ->send();

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }

        return $next($request);
    }
}
