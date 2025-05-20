<?php

namespace App\Filament\Resources\AssetRegisteredResource\Pages;

use App\Filament\Resources\AssetRegisteredResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetRegistered extends EditRecord
{
    protected static string $resource = AssetRegisteredResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getExtraScripts(): array
    {
        return [
            asset('js/custom-script.js'),
        ];
    }
}
