<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetStock extends Model
{
    use HasFactory;

    protected $fillable = ['asset_id', 'location_id', 'room_id', 'quantity'];

    public function asset() { return $this->belongsTo(Asset::class); }
    public function location() { return $this->belongsTo(Location::class); }
    public function room() { return $this->belongsTo(Room::class); }
}
