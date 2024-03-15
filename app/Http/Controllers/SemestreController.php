<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Affiche la liste de tous les semestres.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $semestres = Semestre::all();
        return response()->json($semestres, 200);
    }

    /**
     * Crée un nouveau semestre.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Validation (Vous devriez la mettre dans une FormRequest)
        $request->validate([
            'nom' => 'required|string',
            'filiere_id' => 'required|exists:filieres,id' // Relation potentielle
        ]);

        $semestre = Semestre::create($request->all());
        return response()->json($semestre, 201);
    }

    /**
     *  Affiche un semestre spécifique.
     *
     * @param Semestre $semestre
     * @return JsonResponse
     */
    public function show(Semestre $semestre)
    {
        return response()->json($semestre, 200);
    }

    /**
     * Met à jour un semestre existant.
     *
     * @param Request $request
     * @param Semestre $semestre
     * @return JsonResponse
     */
    public function update(Request $request, Semestre $semestre)
    {
        // Validation (Vous devriez la mettre dans une FormRequest)
        $request->validate([
            'name' => 'sometimes|required|string',
            'filiere_id' => 'sometimes|required|exists:filieres,id' // Relation potentielle
        ]);

        $semestre->update($request->all());
        return response()->json($semestre, 200);
    }

    /**
     * Supprime un semestre.
     *
     * @param Semestre $semestre
     * @return JsonResponse
     */
    public function destroy(Semestre $semestre)
    {
        $semestre->delete();
        return response()->json(null, 204);
    }
}
