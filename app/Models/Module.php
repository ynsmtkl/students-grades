<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description'
    ];

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function enseignant(){
        return $this->belongsTo(Enseignant::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
