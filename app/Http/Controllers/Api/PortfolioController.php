<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioHomeResource;
use App\Models\ProfileHighlight;
use App\Models\ProfileSetting;
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

        $socialLinks = SocialLink::query()
            ->visible()
            ->ordered()
            ->get();

        $highlights = ProfileHighlight::query()
            ->visible()
            ->ordered()
            ->get();

        return new PortfolioHomeResource([
            'profile' => $profile,
            'skills' => $skills,
            'social_links' => $socialLinks,
            'highlights' => $highlights,
        ]);
    }

    // public function getHeroData(Request $request): PortfolioHomeResource
    // {
    //     $profile = ProfileSetting::query()
    //         ->active()
    //         ->orderBy('id')
    //         ->first();

    //     $socialLinks = SocialLink::query()
    //         ->visible()
    //         ->ordered()
    //         ->get();

    //     return new PortfolioHomeResource([
    //         'profile' => $profile,
    //         'social_links' => $socialLinks,
    //     ]);
    // }
}
