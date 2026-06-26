<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioHomeResource;
use App\Models\ProfileExpertise;
use App\Models\ProfileHighlight;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function getHomeData(Request $request): PortfolioHomeResource
    {
        $profile = ProfileSetting::query()
            ->active()
            ->orderBy('id')
            ->first();

        $skills = Skill::query()
            ->visible()
            ->orderByDesc('is_featured')
            ->ordered()
            ->get();

        $projects = Project::query()
            ->published()
            ->featured()
            ->ordered()
            ->limit(6)
            ->get();

        if ($projects->count() < 6) {
            $missing = 6 - $projects->count();

            $extraProjects = Project::query()
                ->published()
                ->where('is_featured', false)
                ->ordered()
                ->limit($missing)
                ->get();

            $projects = $projects->concat($extraProjects)->values();
        }

        $socialLinks = SocialLink::query()
            ->visible()
            ->ordered()
            ->get();

        $highlights = ProfileHighlight::query()
            ->visible()
            ->ordered()
            ->get();

        $expertise = ProfileExpertise::query()
            ->visible()
            ->ordered()
            ->get();

        return new PortfolioHomeResource([
            'profile' => $profile,
            'skills' => $skills,
            'projects' => $projects,
            'social_links' => $socialLinks,
            'highlights' => $highlights,
            'expertise' => $expertise,
        ]);
    }
}
