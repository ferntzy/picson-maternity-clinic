<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure profile data is loaded and merged into form data
        if ($this->record && $this->record->profile) {
            $profile = $this->record->profile;
            $data['profile'] = [
                'firstname' => $profile->firstname,
                'middlename' => $profile->middlename,
                'lastname' => $profile->lastname,
                'birth_date' => $profile->birth_date,
                'sex' => $profile->sex,
                'birth_place' => $profile->birth_place,
                'civil_status' => $profile->civil_status,
                'nationality' => $profile->nationality,
                'religion' => $profile->religion,
                'address' => $profile->address,
                'contact_num' => $profile->contact_num,
                'emergency_contact_name' => $profile->emergency_contact_name,
                'emergency_contact_number' => $profile->emergency_contact_number,
                'philhealth_number' => $profile->philhealth_number,
                'blood_type' => $profile->blood_type,
                'allergies' => $profile->allergies,
                'role' => $profile->role,
            ];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Extract profile data and update the profile relationship
        if (isset($data['profile']) && $this->record && $this->record->profile) {
            $profileData = $data['profile'];
            $this->record->profile->update($profileData);
            unset($data['profile']);
        }

        return $data;
    }
}
