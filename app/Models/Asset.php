<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'master_data_assets';
    protected $fillable = [
        'product_code',
        'name',
        'category',
        'merk',
        'unit',
    ];

    // Transactions
    public function transactions()
{
    return $this->hasMany(AssetTransaction::class, 'asset_id');
}

public function getStockAttribute()
{
    $in = $this->transactions()->where('type', 'in')->sum('quantity');
    $out = $this->transactions()->where('type', 'out')->sum('quantity');
    return $this->initial_quantity + $in - $out;
}

public function getStatusAttribute()
{
    $stock = $this->stock;

    // Disposal jika usia aset > 5 tahun
    $age = now()->diffInYears($this->created_at);
    if ($age >= 5) return 'Disposal';

    if ($stock === 0) return 'Habis';
    if ($stock <= 5) return 'Hampir Habis';
    return 'Tersedia';
}

}
