<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alerte;

class Propriete extends Model
{
    use HasFactory;

    protected $table = "propriete";

    protected $fillable = [
        "qrcode",
        "nom",
        "prenom",
        "typepropriete",
        "adresse",
        "codepostal",
        "ville",
        "status"
    ];

    public function Alerte() {
        return $this->hasMany(Alerte::class, 'propriete_id', 'id');
    }

}
