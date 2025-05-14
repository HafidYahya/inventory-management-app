<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetRegistered extends Model
{
    protected $fillable = [
        'master_data_asset_id',
        'epc',
        'note',
        'default_quantity',
        'is_registered',
    ];

    public function masterDataAsset()
    {
        return $this->belongsTo(Asset::class);
    }
}
