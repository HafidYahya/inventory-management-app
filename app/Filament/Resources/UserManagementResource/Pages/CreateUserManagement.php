<?php

namespace App\Filament\Resources\UserManagementResource\Pages;

use App\Filament\Resources\UserManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Helpers\Activity;

class CreateUserManagement extends CreateRecord
{
    protected static string $resource = UserManagementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    Activity::log(
        'create',
        'Users Management',
        "Create a new user with the name \"{$data['name']}\" and email {$data['email']}."
    );

    return $data;
}
}
