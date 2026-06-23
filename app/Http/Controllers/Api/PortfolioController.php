<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioHomeResource;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function getHomeData(Request $request): PortfolioHomeResource
    {
        $profile = ProfileSetting::query()->orderBy('id')->first();

        $skills = Skill::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $projects = Project::query()
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return new PortfolioHomeResource([
            'profile' => $profile,
            'skills' => $skills,
            'projects' => $projects,
        ]);
    }
}
