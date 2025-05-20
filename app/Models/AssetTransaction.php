<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'registered_asset_id',
        'location_id',
        'room_id',
        'type',
        'stock_out_reason_id',
        'quantity',
        'reason',
        'user_id',
    ];

    // Relasi ke aset utama
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    // Relasi ke aset terdaftar (untuk stok in)
    public function registeredAsset()
    {
        return $this->belongsTo(AssetRegistered::class);
    }

    // Lokasi penempatan / tujuan
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Alasan stok out (relasi ke master data)
    public function stockOutReason()
    {
        return $this->belongsTo(StockOutReason::class);
    }

    // User yang melakukan transaksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
