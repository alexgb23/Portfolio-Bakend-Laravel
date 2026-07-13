<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCardResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    // Lista simple de proyectos para tarjetas.
    public function index()
    {
        $projects = Project::query()
            ->with([
                'laboratorioReal:id,titulo,slug,estado',
                'adjuntos:id,project_id,titulo,url,es_visible',
            ])
            ->ordered()
            ->get();

        return ProjectCardResource::collection($projects);
    }

    // Detalle completo con relaciones.
    public function show(string $slug): ProjectResource
    {
        $project = Project::query()
            ->with([
                'laboratorioReal:id,titulo,slug,estado',
                'adjuntos',
                'documentacion',
                'secciones',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return new ProjectResource($project);
    }

    // Crea un proyecto ajustado al esquema actual.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratorio_real_id' => 'nullable|exists:laboratorios_reales,id',

            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'area_principal' => 'nullable|string|max:255',

            'description' => 'required|string',
            'short_description' => 'nullable|string|max:280',
            'resumen' => 'nullable|string',
            'notas_tecnicas' => 'nullable|string',
            'objetivo' => 'nullable|string',
            'resultado_actual' => 'nullable|string',

            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:255',
            'stack_summary' => 'nullable|string|max:255',

            'metadata' => 'nullable|array',

            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        if (blank($validated['slug'] ?? null) && filled($validated['title'] ?? null)) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['technologies'] = array_values(array_filter(
            $validated['technologies'] ?? [],
            fn($item) => filled($item)
        ));

        $project = Project::create($validated);

        $project->load([
            'laboratorioReal:id,titulo,slug,estado',
            'adjuntos',
            'documentacion',
            'secciones',
        ]);

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(201);
    }

    // Actualiza un proyecto ajustado al esquema actual.
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
            'area_principal' => 'nullable|string|max:255',

            'description' => 'required|string',
            'short_description' => 'nullable|string|max:280',
            'resumen' => 'nullable|string',
            'notas_tecnicas' => 'nullable|string',
            'objetivo' => 'nullable|string',
            'resultado_actual' => 'nullable|string',

            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:255',
            'stack_summary' => 'nullable|string|max:255',

            'metadata' => 'nullable|array',

            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        if (blank($validated['slug'] ?? null) && filled($validated['title'] ?? null)) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['technologies'] = array_values(array_filter(
            $validated['technologies'] ?? [],
            fn($item) => filled($item)
        ));

        $project->update($validated);

        $project->load([
            'laboratorioReal:id,titulo,slug,estado',
            'adjuntos',
            'documentacion',
            'secciones',
        ]);

        return new ProjectResource($project);
    }

    // Elimina un proyecto.
    public function destroy(string $id)
    {
        $project = Project::query()->findOrFail($id);
        $project->delete();

        return response()->json([
            'message' => 'Proyecto eliminado correctamente',
        ]);
    }
}
