<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Relasi ke Room
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    protected $table = 'master_data_locations';
    protected $fillable = [
        'code',
        'name',
        'description',
    ];
}
