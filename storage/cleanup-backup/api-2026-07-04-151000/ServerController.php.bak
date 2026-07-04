<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Models\Server;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::query()
            ->select([
                'id',
                'hostname',
                'display_name',
                'role',
                'provider',
                'environment',
                'location_name',
                'virtualization_type',
                'os',
                'public_ip',
                'cpu_usage',
                'ram_usage',
                'uptime',
                'status',
                'notes',
                'is_featured',
                'sort_order',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return ServerResource::collection($servers);
    }

    public function show(string $id): ServerResource
    {
        $server = Server::query()->findOrFail($id);

        return new ServerResource($server);
    }
}
