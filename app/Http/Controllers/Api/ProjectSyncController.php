<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\LaboratorioReal;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectSyncController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'repo_url' => ['required', 'url', 'max:255'],

            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string', 'max:280'],

            'area_principal' => ['nullable', 'string', 'max:255'],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:255'],
            'stack_summary' => ['nullable', 'string', 'max:255'],

            'project_url' => ['nullable', 'url'],
            'frontend_url' => ['nullable', 'url'],
            'backend_url' => ['nullable', 'url'],
            'image_url' => ['nullable', 'url'],

            'metadata' => ['nullable', 'array'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],

            'laboratorio_real_slug' => ['nullable', 'string', 'exists:laboratorios_reales,slug'],
        ]);

        $laboratorioId = null;

        if (! empty($validated['laboratorio_real_slug'])) {
            $laboratorioId = LaboratorioReal::query()
                ->where('slug', $validated['laboratorio_real_slug'])
                ->value('id');
        }

        $project = Project::query()
            ->where('repo_url', $validated['repo_url'])
            ->first();

        if (! $project) {
            $project = new Project();

            $slug = $validated['slug'] ?? Str::slug($validated['title']);

            $exists = Project::query()->where('slug', $slug)->exists();

            if ($exists) {
                $slug = $slug . '-' . Str::random(6);
            }

            $project->slug = $slug;
        }

        $project->repo_url = $validated['repo_url'];
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->short_description = $validated['short_description'] ?? null;
        $project->area_principal = $validated['area_principal'] ?? null;
        $project->technologies = array_values(array_filter($validated['technologies'] ?? []));
        $project->stack_summary = $validated['stack_summary'] ?? null;
        $project->project_url = $validated['project_url'] ?? null;
        $project->frontend_url = $validated['frontend_url'] ?? null;
        $project->backend_url = $validated['backend_url'] ?? null;
        $project->image_url = $validated['image_url'] ?? null;
        $project->metadata = $validated['metadata'] ?? [];
        $project->fecha_inicio = $validated['fecha_inicio'] ?? null;
        $project->fecha_fin = $validated['fecha_fin'] ?? null;
        $project->laboratorio_real_id = $laboratorioId;

        $project->save();

        $project->load([
            'laboratorioReal:id,titulo,slug,estado',
            'adjuntos',
            'documentacion',
            'secciones',
        ]);

        return response()->json([
            'message' => 'Proyecto sincronizado correctamente.',
            'project' => new ProjectResource($project),
        ]);
    }
}
