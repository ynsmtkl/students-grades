<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Inscription;
use App\Models\Module;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index(){
        $data = Module::with(['filiere', 'enseignant'])->get();

        return response()->json($data);
    }

    public function moduleByFiliereSemestre(Filiere $filiere, Semestre $semestre){
        $modules = Affectation::where([
            ['semestre_id', '=', $semestre->id],
            ['filiere_id', '=', $filiere->id],
        ])->with(['enseignant.user', 'module'])->get();

        return response()->json($modules);
    }

    public function moduleByFiliere(Filiere $filiere){
        $modules = Affectation::where('filiere_id', $filiere->id)
            ->with(['semestre', 'module.enseignant.user'])
            ->get()
            ->groupBy('semestre_id');

        return response()->json($modules);
    }

    public function modulesEnseignant(Enseignant $enseignant){
        $modules = Affectation::where('enseignant_id', $enseignant->id)
            ->with('module')->get();

        $modules = $modules->map(function ($module) {
            return [
                'filiere' => [
                    $module->filiere->nom,
                    $module->filiere->abbreviation,
                ],
                'semestre' => $module->semestre->nom,
                'module' => [
                    $module->module->nom,
                    $module->module->abbreviation,
                    $module->module->description,
                ],
            ];
        });

        return response()->json($modules);
    }

    public function modulesEtudiant(Etudiant $etudiant){
        $modules = Inscription::where('etudiant_id', $etudiant->id)
            ->with('module', 'semestre')->get();

        $modules = $modules->map(function ($module, $semestre) {
            return [
                /*'filiere' => [
                    $module->filiere->nom,
                    $module->filiere->abbreviation,
                ],*/
                //'semestre' => $semestre->nom,
                'module' => [
                    $module->module->nom,
                    $module->module->abbreviation,
                    $module->module->description,
                ],
            ];
        });

        return response()->json($modules);
    }
}
