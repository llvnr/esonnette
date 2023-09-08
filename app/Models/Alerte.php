<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;

    protected $table = "alerte";

    protected $fillable = [
        "propriete_id",
        "type",
        "informations",
        "etat"
    ];

}
