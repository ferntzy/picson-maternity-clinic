<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\Heroicon;

class Profile extends Page
{
    protected string $view = 'filament.pages.profile';

    protected static ?string $navigationLabel = 'My Profile';

    // ✅ Correct format (matching your other pages)
    // protected static string|BackedEnum|null $navigationIcon = Heroicon::User;

    protected static ?int $navigationSort = 999;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
