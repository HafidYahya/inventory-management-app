<?php

namespace App\Filament\Resources\AssetStokInResource\Pages;

use App\Filament\Resources\AssetStokInResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetStokIns extends ListRecords
{
    protected static string $resource = AssetStokInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
