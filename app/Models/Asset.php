<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

// Relasi ke stok berjalan
    public function stocks(): HasMany
    {
        return $this->hasMany(AssetStock::class, 'asset_id');
    }

    // 🔁 Jumlah total stok dari asset_stocks
    public function getStockAttribute(): int
    {
        return $this->stocks()->sum('quantity'); // ✅ ini sumber stok sekarang
    }

// 💡 Status stok
    public function getStatusAttribute(): string
    {
        $stock = $this->stock;
        $age = now()->diffInYears($this->created_at);

        if ($age >= 5) return 'Disposal';
        if ($stock === 0) return 'Habis';
        if ($stock <= 5) return 'Hampir Habis';
        return 'Tersedia';
    }

}
