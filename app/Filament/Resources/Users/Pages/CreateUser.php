<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Validate profile selection
        if (!isset($data['profile_id'])) {
            throw ValidationException::withMessages([
                'profile_id' => 'You must select a profile.',
            ]);
        }

        // Extract profile data if provided
        $profileData = $data['profile'] ?? [];

        // Update the selected profile with role and other data
        if (!empty($profileData) && isset($data['profile_id'])) {
            $profile = \App\Models\Profiles::find($data['profile_id']);
            if ($profile) {
                $profile->update($profileData);
            }
        }

        // Remove profile data and password confirmation from user data
        unset($data['password_confirmation']);
        unset($data['profile']);

        return $data;
    }
}
