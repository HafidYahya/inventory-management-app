<?php

namespace App\Filament\Resources\AssetTransactionResource\Pages;

use App\Filament\Resources\AssetTransactionResource;
use Filament\Resources\Pages\CreateRecord;
use App\Helpers\Activity;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;

class CreateAssetTransaction extends CreateRecord
{
    protected static string $resource = AssetTransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        $asset = Asset::find($data['asset_id']);
        $typeText = $data['type'] === 'in' ? 'Stok In' : 'Stok Out';

        if ($asset) {
            Activity::log(
                'create',
                $typeText,
                "{$typeText} untuk aset \"{$asset->name}\" sebanyak {$data['quantity']} unit."
            );
        }

        return $data;
    }
}
