<?php

namespace App\Filament\Resources\StokOutReasonResource\Pages;

use App\Filament\Resources\StokOutReasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStokOutReason extends EditRecord
{
    protected static string $resource = StokOutReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
