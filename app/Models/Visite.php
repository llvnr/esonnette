<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alerte;
use App\Models\Propriete;

class Visite extends Model
{
    use HasFactory;

    protected $table = "visite";

    protected $fillable = [
        'propriete_id',
        'alerte_id',
        'adresse_ip',
        'denomination',
        'telephone',
        'etat'
    ];

    public function alerte() {
        return $this->belongsTo(Alerte::class, 'alerte_id', 'id');
    }

    public function propriete() {
        return $this->belongsTo(Propriete::class, 'propriete_id', 'id');
    }

}
