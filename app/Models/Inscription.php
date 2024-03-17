<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'module_id',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
