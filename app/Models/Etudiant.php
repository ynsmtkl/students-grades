<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_naissance',
        'numero_etudiant',
        'filiere_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semestres()
    {
        return $this->belongsToMany(Semestre::class, 'inscriptions');
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }
}
