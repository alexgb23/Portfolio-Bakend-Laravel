<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Project::orderBy('id', 'desc')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'project_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
        ]);

        $project = Project::create($validated);

        return response()->json([
            'message' => 'Proyecto creado con éxito',
            'project' => $project
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Proyecto no encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'project_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
        ]);

        $project->update($validated);

        return response()->json([
            'message' => 'Proyecto actualizado con éxito',
            'project' => $project
        ]);
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Proyecto no encontrado'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'message' => 'Proyecto eliminado correctamente'
        ]);
    }
}
