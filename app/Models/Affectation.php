<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
}
