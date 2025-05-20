<?php

namespace App\Filament\Resources\AssetRegisteredResource\Pages;

use App\Filament\Resources\AssetRegisteredResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetRegistered extends CreateRecord
{
    protected static string $resource = AssetRegisteredResource::class;

    public function getHeader(): ?\Illuminate\View\View
    {
        return view('scripts.rfid-script');
    }

    
}
