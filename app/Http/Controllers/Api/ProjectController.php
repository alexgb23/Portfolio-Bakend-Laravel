<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCardResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->published()
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        return ProjectCardResource::collection($projects);
    }

    public function show(string $id): ProjectResource
    {
        $project = Project::query()
            ->published()
            ->findOrFail($id);

        return new ProjectResource($project);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "short_description" => "nullable|string|max:280",
            "technologies" => "required|string|max:255",
            "stack_summary" => "nullable|string|max:255",
            "image_url" => "nullable|url",
            "project_url" => "nullable|url",
            "repo_url" => "nullable|url",
            "status" => "nullable|string|max:50",
            "is_featured" => "nullable|boolean",
            "is_published" => "nullable|boolean",
            "sort_order" => "nullable|integer|min:0",
        ]);

        if (empty($validated["slug"] ?? null) && !empty($validated["title"])) {
            $validated["slug"] = Str::slug($validated["title"]);
        }

        $project = Project::create($validated);

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, string $id)
    {
        $project = Project::query()->findOrFail($id);

        $validated = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "short_description" => "nullable|string|max:280",
            "technologies" => "required|string|max:255",
            "stack_summary" => "nullable|string|max:255",
            "image_url" => "nullable|url",
            "project_url" => "nullable|url",
            "repo_url" => "nullable|url",
            "status" => "nullable|string|max:50",
            "is_featured" => "nullable|boolean",
            "is_published" => "nullable|boolean",
            "sort_order" => "nullable|integer|min:0",
        ]);

        if (empty($project->slug) && !empty($validated["title"])) {
            $validated["slug"] = Str::slug($validated["title"]);
        }

        $project->update($validated);

        return new ProjectResource($project);
    }

    public function destroy(string $id)
    {
        $project = Project::query()->findOrFail($id);

        $project->delete();

        return response()->json([
            "message" => "Proyecto eliminado correctamente",
        ]);
    }
}
