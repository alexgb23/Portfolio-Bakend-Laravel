<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioHomeResource;
use App\Models\ProfileHighlight;
use App\Models\ProfileSetting;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Project;
use App\Models\Metric;
use App\Models\Node;
use App\Models\Server;

use Illuminate\Http\Request;

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
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        $servers = Server::query()
            ->featured()
            ->ordered()
            ->get();

        $nodes = Node::query()
            ->active()
            ->featured()
            ->ordered()
            ->get();

        $metrics = Metric::query()
            ->featured()
            ->ordered()
            ->get();




        // $profile = ProfileSetting::query()
        //     ->active()
        //     ->orderBy('id')
        //     ->first();

        // $skills = Skill::query()
        //     ->visible()
        //     ->orderByDesc('is_featured')
        //     ->ordered()
        //     ->get();


        // $highlights = ProfileHighlight::query()
        //     ->visible()
        //     ->ordered()
        //     ->get();

        return new PortfolioHomeResource([
            'social_links' => $socialLinks,
            'projects' => $projects,
            'servers' => $servers,
            'nodes' => $nodes,
            'metrics' => $metrics,
            

            // 'profile' => $profile,
            // 'skills' => $skills,
            // 'highlights' => $highlights,
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
