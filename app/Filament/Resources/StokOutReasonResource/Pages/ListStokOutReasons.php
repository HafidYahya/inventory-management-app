<?php

namespace App\Filament\Resources\StokOutReasonResource\Pages;

use App\Filament\Resources\StokOutReasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStokOutReasons extends ListRecords
{
    protected static string $resource = StokOutReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
