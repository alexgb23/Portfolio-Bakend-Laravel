<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClusterResource;
use App\Http\Resources\HomeAssistantInstanceResource;
use App\Http\Resources\LabCapabilityResource;
use App\Http\Resources\LaboratoryCardResource;
use App\Http\Resources\LaboratoryHomeResource;
use App\Http\Resources\LocalAiSetupResource;
use App\Http\Resources\MetricResource;
use App\Http\Resources\NodeResource;
use App\Http\Resources\ServerResource;
use App\Models\Cluster;
use App\Models\HomeAssistantInstance;
use App\Models\LabCapability;
use App\Models\LaboratoryItem;
use App\Models\LocalAiSetup;
use App\Models\Metric;
use App\Models\Node;
use App\Models\Server;
use Illuminate\Http\Request;

class LaboratoryHomeController extends Controller
{
    public function index(Request $request): LaboratoryHomeResource
    {
        $featuredItems = LaboratoryItem::query()
            ->visible()
            ->ordered()
            ->get();

        $clusters = Cluster::query()
            ->active()
            ->with("servers")
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

        $homeAssistant = HomeAssistantInstance::query()
            ->visible()
            ->active()
            ->with("useCases")
            ->ordered()
            ->get();

        $localAi = LocalAiSetup::query()
            ->visible()
            ->active()
            ->ordered()
            ->get();

        $capabilities = LabCapability::query()
            ->visible()
            ->active()
            ->ordered()
            ->get();

        return new LaboratoryHomeResource([
            "summary" => [
                "featured_items_count" => $featuredItems->count(),
                "clusters_count" => $clusters->count(),
                "servers_count" => $servers->count(),
                "nodes_count" => $nodes->count(),
                "metrics_count" => $metrics->count(),
            ],
            "featured_items" => LaboratoryCardResource::collection($featuredItems),
            "clusters" => ClusterResource::collection($clusters),
            "servers" => ServerResource::collection($servers),
            "nodes" => NodeResource::collection($nodes),
            "metrics" => MetricResource::collection($metrics),
            "home_assistant" => HomeAssistantInstanceResource::collection($homeAssistant),
            "local_ai" => LocalAiSetupResource::collection($localAi),
            "capabilities" => LabCapabilityResource::collection($capabilities),
        ]);
    }
}
