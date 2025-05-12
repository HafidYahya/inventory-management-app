<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'master_data_locations';
    protected $fillable = [
        'code',
        'name',
        'description',
    ];
}
