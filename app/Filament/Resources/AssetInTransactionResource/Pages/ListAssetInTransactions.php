<?php

namespace App\Filament\Resources\AssetInTransactionResource\Pages;

use App\Filament\Resources\AssetInTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetInTransactions extends ListRecords
{
    protected static string $resource = AssetInTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
