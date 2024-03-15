<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class StudentController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with('user', 'filiere')->get();

        $data = [];

        foreach ($etudiants as $etudiant) {
            $data[] = [
                'id' => $etudiant->id,
                'nom' => $etudiant->user->nom,
                'prenom' => $etudiant->user->prenom,
                'email' => $etudiant->user->email,
                "date_naissance"=> date('d-m-Y', strtotime($etudiant->date_naissance)),
                "numero_etudiant"=> $etudiant->numero_etudiant,
                'filiere' => $etudiant->filiere->abreviation,
            ];
        }

        return response()->json($data);
    }

    public function byModule(Request $request){
        $id = $request->id;


    }
}
