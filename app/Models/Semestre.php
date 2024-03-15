<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'annee_universitaire',
        'date_debut',
        'date_fin',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
