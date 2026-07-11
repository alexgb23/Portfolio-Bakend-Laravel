<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Http\Resources\PortfolioHomeResource;
use App\Models\LaboratorioReal;
use App\Models\ProfileHighlight;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Http\Request;

/**
 * @tags Portfolio
 */
class PortfolioController extends Controller
{
    public function getHomeData(Request $request): PortfolioHomeResource
    {
        $socialLinks = SocialLink::query()
            ->visible()
            ->ordered()
            ->get();

        $projects = Project::query()
            ->published()
            ->orderByDesc('is_featured')
            ->ordered()
            ->get();

        $laboratories = LaboratorioReal::query()
            ->where('es_visible', true)
            ->orderByDesc('es_destacado')
            ->orderBy('orden')
            ->withCount(['documentacion', 'avances', 'ideas', 'adjuntos'])
            ->get();

        return new PortfolioHomeResource([
            'social_links' => $socialLinks,
            'projects' => $projects,
            'laboratories' => $laboratories,
        ]);
    }

    public function getAboutData(Request $request): AboutResource
    {
        $skills = Skill::query()
            ->visible()
            ->orderByDesc('is_featured')
            ->ordered()
            ->get();

        $highlights = ProfileHighlight::query()
            ->visible()
            ->ordered()
            ->get();

        return new AboutResource([
            'skills' => $skills,
            'highlights' => $highlights,
        ]);
    }
}
