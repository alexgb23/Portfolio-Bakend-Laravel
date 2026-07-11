<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->published()
            ->with('laboratorioReal:id,titulo,slug,estado')
            ->orderByDesc('is_featured')
            ->ordered()
            ->get();

        return ProjectResource::collection($projects);
    }

    public function show(string $slug): ProjectResource
    {
        $project = Project::query()
            ->published()
            ->with('laboratorioReal:id,titulo,slug,estado')
            ->where('slug', $slug)
            ->firstOrFail();

        return new ProjectResource($project);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratorio_real_id' => 'nullable|exists:laboratorios_reales,id',

            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',

            'tipo_proyecto' => 'nullable|string|max:255',
            'area_principal' => 'nullable|string|max:255',
            'areas_relacionadas' => 'nullable|array',
            'areas_relacionadas.*' => 'string|max:255',

            'description' => 'required|string',
            'short_description' => 'nullable|string|max:280',
            'resumen' => 'nullable|string',
            'notas_tecnicas' => 'nullable|string',
            'objetivo' => 'nullable|string',
            'resultado_actual' => 'nullable|string',

            'technologies' => 'required|string|max:255',
            'stack_summary' => 'nullable|string|max:255',

            'image_url' => 'nullable|array',
            'image_url.*' => 'required|url',

            'galeria_urls' => 'nullable|array',
            'galeria_urls.*' => 'required|url',

            'documentacion_urls' => 'nullable|array',
            'documentacion_urls.*' => 'required|url',

            'project_url' => 'nullable|url',
            'frontend_url' => 'nullable|url',
            'backend_url' => 'nullable|url',
            'api_base_url' => 'nullable|url',
            'staging_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'referencia_externa' => 'nullable|url',

            'metadata' => 'nullable|array',

            'status' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',

            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        if (empty($validated['slug']) && !empty($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $project = Project::create($validated);

        $project->load('laboratorioReal:id,titulo,slug,estado');

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, string $id)
    {
        $project = Project::query()->findOrFail($id);

        $validated = $request->validate([
            'laboratorio_real_id' => 'nullable|exists:laboratorios_reales,id',

            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('projects', 'slug')->ignore($project->id),
            ],

            'tipo_proyecto' => 'nullable|string|max:255',
            'area_principal' => 'nullable|string|max:255',
            'areas_relacionadas' => 'nullable|array',
            'areas_relacionadas.*' => 'string|max:255',

            'description' => 'required|string',
            'short_description' => 'nullable|string|max:280',
            'resumen' => 'nullable|string',
            'notas_tecnicas' => 'nullable|string',
            'objetivo' => 'nullable|string',
            'resultado_actual' => 'nullable|string',

            'technologies' => 'required|string|max:255',
            'stack_summary' => 'nullable|string|max:255',

            'image_url' => 'nullable|array',
            'image_url.*' => 'required|url',

            'galeria_urls' => 'nullable|array',
            'galeria_urls.*' => 'required|url',

            'documentacion_urls' => 'nullable|array',
            'documentacion_urls.*' => 'required|url',

            'project_url' => 'nullable|url',
            'frontend_url' => 'nullable|url',
            'backend_url' => 'nullable|url',
            'api_base_url' => 'nullable|url',
            'staging_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'referencia_externa' => 'nullable|url',

            'metadata' => 'nullable|array',

            'status' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',

            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        if (empty($validated['slug']) && !empty($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $project->update($validated);

        $project->load('laboratorioReal:id,titulo,slug,estado');

        return new ProjectResource($project);
    }

    public function destroy(string $id)
    {
        $project = Project::query()->findOrFail($id);

        $project->delete();

        return response()->json([
            'message' => 'Proyecto eliminado correctamente',
        ]);
    }
}
