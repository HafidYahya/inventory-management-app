<?php

namespace App\Filament\Resources\AssetInTransactionResource\Pages;

use App\Filament\Resources\AssetInTransactionResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\AssetRegistered;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Activity;

class CreateAssetInTransaction extends CreateRecord
{
    protected static string $resource = AssetInTransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $registered = \App\Models\AssetRegistered::with('masterDataAsset')->find($data['registered_asset_id']);

    // Tandai sudah diregister
    $registered->update(['is_registered' => true]);

    // Data transaksi
    $data['asset_id'] = $registered->master_data_asset_id;
    $data['type'] = 'in';
    $data['user_id'] = \Illuminate\Support\Facades\Auth::id();

    // Update asset_stocks
    $stock = \App\Models\AssetStock::firstOrCreate(
        [
            'asset_id' => $data['asset_id'],
            'location_id' => $data['location_id'],
            'room_id' => $data['room_id'],
        ],
        [
            'quantity' => 0
        ]
    );

    $stock->increment('quantity', $data['quantity']);

    // Log aktivitas
    $assetName = optional($registered->masterDataAsset)->name ?? 'Tidak diketahui';
    \App\Helpers\Activity::log(
        'create',
        'Stok In',
        "Stok In untuk aset '{$assetName}' sebanyak {$data['quantity']} ke lokasi {$stock->location->name}, ruangan {$stock->room->name}."
    );

    return $data;
}

}
