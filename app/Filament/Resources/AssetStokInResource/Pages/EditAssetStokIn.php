<?php

namespace App\Filament\Resources\AssetStokInResource\Pages;

use App\Filament\Resources\AssetStokInResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetStokIn extends EditRecord
{
    protected static string $resource = AssetStokInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
