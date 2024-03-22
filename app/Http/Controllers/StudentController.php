<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Inscription;
use App\Models\Module;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

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
                'filiere' => $etudiant->filiere->abbreviation,
            ];
        }

        return response()->json($data);
    }

    public function show(Etudiant $etudiant){
        $etudiant = Etudiant::with('user')
            ->where("etudiant.id", "=", $etudiant.id)
            ->get();

        $data[] = [
            'id' => $etudiant->id,
            'nom' => $etudiant->user->nom,
            'prenom' => $etudiant->user->prenom,
            'email' => $etudiant->user->email,
            "date_naissance"=> date('d-m-Y', strtotime($etudiant->date_naissance)),
            "numero_etudiant"=> $etudiant->numero_etudiant,
            'filiere' => $etudiant->filiere->abbreviation,
        ];

        return response()->json($data);
    }

    public function addStudent(Request $request){
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date_naissance' => 'required|date',
            'numero_etudiant' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        // Créer un nouvel utilisateur
        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'etudiant', // Définir le rôle par défaut à "étudiant"
        ]);

        // Créer un nouvel étudiant
        $etudiant = Etudiant::create([
            'user_id' => $user->id,
            'date_naissance' => $validatedData['date_naissance'],
            'numero_etudiant' => $validatedData['numero_etudiant'],
            'filiere_id' => $validatedData['filiere_id'],
        ]);

        return response()->json("success", 200);
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $etudiant->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'date_naissance' => 'required|date',
            'numero_etudiant' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        // Mettre à jour l'utilisateur
        $etudiant->user->update([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Mettre à jour l'étudiant
        $etudiant->update([
            'date_naissance' => $validatedData['date_naissance'],
            'numero_etudiant' => $validatedData['numero_etudiant'],
            'filiere_id' => $validatedData['filiere_id'],
        ]);

        $data = ["success", "Etudiant modifié avec succès"];

        return response()->json($data, 200);
    }

    public function destroy(Etudiant $etudiant)
    {
        // Supprimer l'utilisateur
        $etudiant->user->delete();

        // Supprimer l'étudiant
        $etudiant->delete();

        $data = ["success", "Etudiant supprimé avec succès"];
        // Rediriger vers une page de succès
        return response()->json($data, 200);
    }

    public function byModule(Module $module){

        $inscriptions = Inscription::with("etudiant.user", "module.enseignant")
            ->where("module_id", "=", $module->id)
            ->get();

        $data = [];

        foreach ($inscriptions as $inscription) {
            $data[] = [
                'id' => $inscription->etudiant->id,
                'nom' => $inscription->etudiant->user->nom,
                'prenom' => $inscription->etudiant->user->prenom,
                'email' => $inscription->etudiant->user->email,
                "date_naissance"=> date('d-m-Y', strtotime($inscription->etudiant->date_naissance)),
                "numero_etudiant"=> $inscription->etudiant->numero_etudiant,
                'filiere' => $inscription->etudiant->filiere->abbreviation,
            ];
        }

        return response()->json($data);
    }
}
