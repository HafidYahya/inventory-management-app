<?php

namespace App\Filament\Resources\UserManagementResource\Pages;

use App\Filament\Resources\UserManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Helpers\Activity;

class EditUserManagement extends EditRecord
{
    protected static string $resource = UserManagementResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }

    protected function mutateFormDataBeforeSave(array $data): array
{
    Activity::log(
        'update',
        'Users Management',
        "Change user data by name \"{$data['name']}\" and email {$data['email']}."
    );

    return $data;
}

}
