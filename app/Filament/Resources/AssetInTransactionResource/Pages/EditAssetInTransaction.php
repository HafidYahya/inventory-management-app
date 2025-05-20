<?php

namespace App\Filament\Resources\AssetInTransactionResource\Pages;

use App\Filament\Resources\AssetInTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetInTransaction extends EditRecord
{
    protected static string $resource = AssetInTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
