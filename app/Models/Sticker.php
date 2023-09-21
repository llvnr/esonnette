<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    use HasFactory;

    protected $table = "sticker";

    protected $fillable = [
        "user_id",
        "propriete_id",
        "configuration"
    ];

    protected $casts = [
        'configuration' => 'json',
    ];

}
