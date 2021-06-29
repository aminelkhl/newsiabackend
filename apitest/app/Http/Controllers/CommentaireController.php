<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commentaire;

class CommentaireController extends Controller
{
    public function index()
    {
        return response()->json(Commentaire::get(), 200);
    }


    public function store(Request $request)
    {
        $comm=Commentaire::create($request->all());
        return response()->json($comm, 200);
    }

    public function show($id)
    {
        return response()->json(Commentaire::find($id), 201);
    }

    public function update(Request $request, $id)
    {
        $comm=Commentaire::find($id);
        $comm->update($request->all());
        return response()->json($comm, 200);

    }


    public function destroy($id)
    {
        $comm=Commentaire::find($id);
        $comm->delete();
        return response()->json(null,204);
    }
}
