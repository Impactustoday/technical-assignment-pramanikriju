<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'hasSolar',
        'panel_count',
        'status',
    ];
}
