<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Faker\Factory;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Filiere::all(), 200);
    }

    public function ajouterData(){
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Filiere::create([
                'nom' => $faker->name,
                'description' => $faker->paragraph,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $filiere = Filiere::create($request->all());

        return response()->json($filiere, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Filiere $filiere)
    {
        return response()->json($filiere, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Filiere $filiere)
    {
        $filiere->update($request->all());

        return response()->json($filiere, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return response()->json(null, 204);
    }
}
