<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'module_id',
        'semestre_id',
        'note_ordinaire',
        'note_rattrapage',
        'note_finale',
        'absent',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }
}
