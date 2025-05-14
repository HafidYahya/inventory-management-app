<?php

namespace App\Filament\Resources\AssetRegisteredResource\Pages;

use App\Filament\Resources\AssetRegisteredResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetRegistereds extends ListRecords
{
    protected static string $resource = AssetRegisteredResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
