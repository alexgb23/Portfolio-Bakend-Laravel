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
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string', 'max:280'],

            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:255'],
            'stack_summary' => ['nullable', 'string', 'max:255'],

            'area_principal' => ['nullable', 'string', 'max:255'],
            'metadata' => ['required', 'array'],
            'metadata.repo_url' => ['required', 'url'],

            'metadata.card_background_dark' => ['nullable', 'array'],
            'metadata.card_background_dark.*' => ['nullable', 'string', 'max:2048'],

            'metadata.card_background_light' => ['nullable', 'array'],
            'metadata.card_background_light.*' => ['nullable', 'string', 'max:2048'],

            'laboratorio_real_slug' => ['nullable', 'string', 'exists:laboratorios_reales,slug'],
        ]);

        $repoUrl = $validated['metadata']['repo_url'];

        $laboratorioId = null;

        if (! empty($validated['laboratorio_real_slug'])) {
            $laboratorioId = LaboratorioReal::query()
                ->where('slug', $validated['laboratorio_real_slug'])
                ->value('id');
        }

        $project = Project::query()
            ->where('metadata->repo_url', $repoUrl)
            ->first();

        if (! $project) {
            $project = new Project();

            $slug = $validated['slug'] ?? Str::slug($validated['title']);

            if (Project::query()->where('slug', $slug)->exists()) {
                $slug .= '-' . Str::random(6);
            }

            $project->slug = $slug;
        }

        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->short_description = $validated['short_description'] ?? null;
        $project->technologies = array_values(array_filter($validated['technologies'] ?? []));
        $project->stack_summary = $validated['stack_summary'] ?? null;
        $project->area_principal = $validated['area_principal'] ?? null;
        $project->metadata = array_merge($project->metadata ?? [], $validated['metadata']);
        $project->laboratorio_real_id = $laboratorioId;

        $project->save();

        $this->syncCardBackgrounds(
            $project,
            $validated['metadata']
        );

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

    private function syncCardBackgrounds(Project $project, array $metadata): void
    {
        $backgrounds = [
            'fondo_tarjeta_dark' => collect($metadata['card_background_dark'] ?? [])
                ->filter()
                ->values()
                ->implode(','),

            'fondo_tarjeta_light' => collect($metadata['card_background_light'] ?? [])
                ->filter()
                ->values()
                ->implode(','),
        ];

        foreach ($backgrounds as $titulo => $url) {
            if ($url === '') {
                $project->adjuntos()
                    ->where('titulo', $titulo)
                    ->delete();

                continue;
            }

            $project->adjuntos()->updateOrCreate(
                [
                    'project_id' => $project->id,
                    'titulo' => $titulo,
                ],
                [
                    'tipo' => 'imagen',
                    'grupo' => 'fondo_tarjeta',
                    'url' => $url,
                    'orden' => $titulo === 'fondo_tarjeta_dark' ? 1 : 2,
                    'es_visible' => true,
                    'es_destacado' => false,
                ]
            );
        }
    }
}
