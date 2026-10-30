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
        $rules = [
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

            'capturas_completas' => ['sometimes', 'boolean'],
            'capturas' => ['sometimes', 'array', 'max:100'],
            'capturas.*.clave' => ['required', 'string', 'max:120', 'regex:/^[a-z0-9-]+$/', 'distinct'],
            'capturas.*.titulo' => ['required', 'string', 'max:255'],
            'capturas.*.url' => ['required', 'url:https', 'max:2048'],
            'capturas.*.public_id' => ['required', 'string', 'max:255'],


            'metadata.card_background_dark' => ['nullable', 'array'],
            'metadata.card_background_dark.*' => ['nullable', 'string', 'max:2048'],

            'metadata.card_background_light' => ['nullable', 'array'],
            'metadata.card_background_light.*' => ['nullable', 'string', 'max:2048'],

            'laboratorio_real_slug' => ['nullable', 'string', 'exists:laboratorios_reales,slug'],
        ];

        foreach (['resumen', 'objetivo', 'notas_tecnicas', 'resultado_actual'] as $field) {
            $rules[$field] = ['sometimes', 'nullable', 'string'];
        }

        foreach (['fecha_inicio', 'fecha_fin'] as $field) {
            $rules[$field] = ['sometimes', 'nullable', 'date'];
        }

        $contentFields = [
            'secciones' => [
                'clave', 'titulo', 'tipo_contenido', 'layout', 'resumen',
                'contenido', 'items', 'media_url', 'codigo_lenguaje',
                'orden', 'es_visible', 'es_destacado', 'metadata',
            ],
            'adjuntos' => [
                'titulo', 'tipo', 'grupo', 'subtitulo', 'descripcion',
                'nombre_archivo', 'mime_type', 'url', 'icono',
                'orden', 'es_visible', 'es_destacado', 'metadata',
            ],
            'documentacion' => [
                'titulo', 'slug', 'seccion', 'tipo', 'resumen',
                'contenido', 'url_referencia', 'orden',
                'es_visible', 'es_destacado', 'metadata',
            ],
        ];

        foreach ($contentFields as $collection => $fields) {
            $rules[$collection] = ['sometimes', 'array', 'max:100'];
            $rules[$collection . '.*'] = ['array:' . implode(',', $fields)];

            foreach ($fields as $field) {
                $fieldRules = ['sometimes', 'nullable', 'string', 'max:255'];

                if (in_array($field, ['contenido', 'resumen', 'descripcion'], true)) {
                    $fieldRules = ['sometimes', 'nullable', 'string'];
                } elseif (in_array($field, ['items', 'metadata'], true)) {
                    $fieldRules = ['sometimes', 'nullable', 'array'];
                } elseif (in_array($field, ['es_visible', 'es_destacado'], true)) {
                    $fieldRules = ['sometimes', 'boolean'];
                } elseif ($field === 'orden') {
                    $fieldRules = ['sometimes', 'integer', 'min:0'];
                } elseif (in_array($field, ['url', 'url_referencia', 'media_url'], true)) {
                    $fieldRules = ['sometimes', 'nullable', 'url:http,https', 'max:2048'];
                }

                $rules[$collection . '.*.' . $field] = $fieldRules;
            }

            $rules[$collection . '.*.titulo'] = ['required', 'string', 'max:255'];
        }

        $rules['secciones.*.clave'] = ['required', 'string', 'max:255', 'distinct'];
        $rules['adjuntos.*.titulo'] = ['required', 'string', 'max:255', 'distinct'];
        $rules['documentacion.*.slug'] = ['required', 'string', 'max:255', 'distinct'];

        $validated = $request->validate($rules);

        $project = \Illuminate\Support\Facades\DB::transaction(function () use ($validated) {
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
        if (array_key_exists('laboratorio_real_slug', $validated)) {
            $project->laboratorio_real_id = $laboratorioId;
        }

        foreach ([
            'resumen', 'objetivo', 'notas_tecnicas',
            'resultado_actual', 'fecha_inicio', 'fecha_fin',
        ] as $field) {
            if (array_key_exists($field, $validated)) {
                $project->{$field} = $validated[$field];
            }
        }

        $project->save();

        $this->syncPortfolioContent($project, $validated);

        $this->syncScreenshots($project, $validated['capturas'] ?? []);

        if (
            ($validated['capturas_completas'] ?? false)
            && !empty($validated['capturas'])
        ) {
            $project->adjuntos()
                ->where('origen', 'cloudinary-auto')
                ->where('grupo', 'capturas')
                ->whereNotIn(
                    'nombre_archivo',
                    array_column($validated['capturas'], 'clave')
                )
                ->delete();
        }



        $this->syncCardBackgrounds(
            $project,
            $validated['metadata']
        );

        return $project;
        });

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
            $metadataKey = $titulo === 'fondo_tarjeta_dark'
                ? 'card_background_dark'
                : 'card_background_light';

            if (!array_key_exists($metadataKey, $metadata)) {
                continue;
            }

            if (strlen($url) > 2048) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'metadata.' . $metadataKey => 'Las URLs combinadas superan los 2048 caracteres.',
                ]);
            }

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

    private function syncScreenshots(Project $project, array $capturas): void
    {
        foreach ($capturas as $index => $captura) {
            $project->adjuntos()->updateOrCreate(
                [
                    'origen' => 'cloudinary-auto',
                    'nombre_archivo' => $captura['clave'],
                ],
                [
                    'titulo' => $captura['titulo'],
                    'tipo' => 'image',
                    'grupo' => 'capturas',
                    'url' => $captura['url'],
                    'mime_type' => 'image/webp',
                    'orden' => 100 + $index,
                    'es_visible' => true,
                    'es_destacado' => false,
                    'metadata' => [
                        'public_id' => $captura['public_id'],
                        'automatico' => true,
                    ],
                ]
            );
        }
    }

    private function syncPortfolioContent(Project $project, array $data): void
    {
        foreach ($data['secciones'] ?? [] as $item) {
            // La clave identifica la sección dentro de este proyecto.
            $project->secciones()->updateOrCreate(
                ['clave' => $item['clave']],
                array_merge($item, ['origen' => 'portfolio-json'])
            );
        }

        foreach ($data['adjuntos'] ?? [] as $item) {
            // No modifica capturas ni adjuntos manuales con el mismo título.
            $project->adjuntos()->updateOrCreate(
                [
                    'titulo' => $item['titulo'],
                    'origen' => 'portfolio-json',
                ],
                array_merge($item, ['origen' => 'portfolio-json'])
            );
        }

        foreach ($data['documentacion'] ?? [] as $item) {
            $project->documentacion()->updateOrCreate(
                [
                    'slug' => $item['slug'],
                    'origen' => 'portfolio-json',
                ],
                array_merge($item, ['origen' => 'portfolio-json'])
            );
        }
    }
}
